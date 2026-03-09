@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in" x-data="{ openCreateModal: false, openCreditModal: false, selectedUser: null }">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Users & Partners</h2>
        <button @click="openCreateModal = true" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Add User
        </button>
    </div>

    <!-- Filters -->
    <div class="flex p-1 bg-gray-100 dark:bg-surface-dark rounded-xl w-fit">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all {{ !request('role') ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500' }}">All</a>
        <a href="{{ route('admin.users.index', ['role' => 'user']) }}" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all {{ request('role') == 'user' ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500' }}">Customers</a>
        <a href="{{ route('admin.users.index', ['role' => 'partner']) }}" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all {{ request('role') == 'partner' ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500' }}">Partners</a>
    </div>

    <!-- Create Modal -->
    <div x-show="openCreateModal" class="fixed inset-0 z-[70] flex items-center justify-center p-4" style="display: none;">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openCreateModal = false"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl border border-border-light dark:border-border-dark overflow-hidden animate-slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Add User</h3>
                    <button @click="openCreateModal = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <form action="{{ route('admin.users.index') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">User Type</label>
                        <select name="role" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                            <option value="user">Regular Customer</option>
                            <option value="partner">Business Partner</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Name</label>
                            <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Email</label>
                            <input type="email" name="email" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold mt-4 shadow-lg shadow-primary/20">Create User</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <!-- DESKTOP TABLE (hidden on mobile) -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">User</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Role</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Credits</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Email</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center font-bold text-xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="block text-slate-800 dark:text-white text-sm font-medium">{{ $user->name }}</span>
                                        @if($user->role === 'partner' && $user->partnerDetails)
                                            <span class="block text-xs text-gray-400">{{ $user->partnerDetails->agency_name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                                        <span class="material-symbols-outlined text-[14px]">shield</span> Admin
                                    </span>
                                @elseif($user->role === 'partner')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                        <span class="material-symbols-outlined text-[14px]">storefront</span> Partner
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-300 border border-blue-100 dark:border-blue-900">
                                        <span class="material-symbols-outlined text-[14px]">person</span> User
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-sm font-mono font-bold text-slate-700 dark:text-gray-300">
                                @if($user->role === 'partner')
                                    {{ $user->partnerDetails->credits ?? 0 }}
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-gray-600 dark:text-gray-400 text-sm">{{ $user->email }}</td>
                            <td class="p-4">
                                <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold cursor-pointer transition-colors {{ $user->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 hover:bg-red-100 hover:text-red-700' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 hover:bg-green-100 hover:text-green-700' }}" title="Click to Toggle Status">
                                        {{ ucfirst($user->status ?? 'active') }}
                                    </button>
                                </form>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($user->role === 'partner')
                                        <!-- History Button -->
                                        <a href="{{ route('admin.users.history', $user->id) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="View Credit History">
                                            <span class="material-symbols-outlined text-[20px]">history</span>
                                        </a>
                                    @endif

                                    @if($user->role !== 'admin')
                                    <!-- Impersonate Button -->
                                    <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 rounded-lg text-gray-400 hover:text-purple-600 hover:bg-purple-50 transition-colors" title="Login as User">
                                            <span class="material-symbols-outlined text-[20px]">login</span>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" @click="$dispatch('confirm-action', { 
                                            title: 'Delete User Account?', 
                                            message: 'This will permanently remove the user and all their data.', 
                                            formId: 'delete-user-{{ $user->id }}' 
                                        })" class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Delete User">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                    
                                    <!-- Edit Button (trigger modal via event) -->
                                    <button @click="$dispatch('open-edit-modal', {id: {{ $user->id }}, name: '{{ $user->name }}', email: '{{ $user->email }}', role: '{{ $user->role }}', credits: {{ $user->partnerDetails->credits ?? 0 }} })" class="text-gray-400 hover:text-slate-800 dark:hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-4 text-center text-gray-500">No users found.</td></tr>
                    @endforelse
            </table>
        </div>

        <!-- MOBILE CARD LIST (visible on mobile only) -->
        <div class="lg:hidden divide-y divide-border-light dark:divide-border-dark">
            @forelse($users as $user)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <div class="flex items-center gap-3 mb-2.5">
                        <div class="size-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center font-bold text-sm flex-shrink-0">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-slate-800 dark:text-white text-sm font-semibold truncate max-w-[150px]">{{ $user->name }}</span>
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300 flex-shrink-0"><span class="material-symbols-outlined" style="font-size:11px">shield</span>Admin</span>
                                @elseif($user->role === 'partner')
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300 flex-shrink-0"><span class="material-symbols-outlined" style="font-size:11px">storefront</span>Partner</span>
                                @else
                                    <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-300 flex-shrink-0"><span class="material-symbols-outlined" style="font-size:11px">person</span>User</span>
                                @endif
                            </div>
                            @if($user->role === 'partner' && $user->partnerDetails)
                                <span class="block text-[11px] text-gray-400 truncate">{{ $user->partnerDetails->agency_name }}</span>
                            @endif
                            <span class="block text-xs text-gray-400 truncate">{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pl-12">
                        <div class="flex items-center gap-2.5">
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold cursor-pointer transition-colors {{ $user->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ ucfirst($user->status ?? 'active') }}
                                </button>
                            </form>
                            @if($user->role === 'partner')
                                <span class="text-xs font-mono font-bold text-slate-600 dark:text-gray-300">{{ $user->partnerDetails->credits ?? 0 }} <span class="text-[10px] text-gray-400 font-sans">cr</span></span>
                            @endif
                        </div>
                        <div class="flex items-center gap-0.5">
                            @if($user->role === 'partner')
                                <a href="{{ route('admin.users.history', $user->id) }}" class="p-1 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50"><span class="material-symbols-outlined text-[18px]">history</span></a>
                            @endif
                            @if($user->role !== 'admin')
                            <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-1 rounded-lg text-gray-400 hover:text-purple-600 hover:bg-purple-50"><span class="material-symbols-outlined text-[18px]">login</span></button>
                            </form>
                            @endif
                            <form id="del-m-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="$dispatch('confirm-action', { title: 'Delete User?', message: 'This will permanently remove the user.', formId: 'del-m-{{ $user->id }}' })" class="p-1 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                            </form>
                            <button @click="$dispatch('open-edit-modal', {id: {{ $user->id }}, name: '{{ $user->name }}', email: '{{ $user->email }}', role: '{{ $user->role }}', credits: {{ $user->partnerDetails->credits ?? 0 }} })" class="p-1 text-gray-400 hover:text-slate-800 dark:hover:text-white"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">No users found.</div>
            @endforelse
        </div>

        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Manage Credits Modal -->
    <div x-show="openCreditModal" class="fixed inset-0 z-[75] flex items-center justify-center p-4" style="display: none;" x-transition.opacity>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openCreditModal = false"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-xl border border-gray-100 dark:border-white/10 overflow-hidden animate-slide-up">
            <template x-if="selectedUser">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Manage Credits</h3>
                        <button @click="openCreditModal = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                    </div>
                    <div class="bg-blue-50 text-blue-800 text-sm p-3 rounded-lg mb-4">
                        Managing credits for <span class="font-bold" x-text="selectedUser.name"></span>
                    </div>
                    
                    <form x-bind:action="'/admin/users/' + selectedUser.id + '/credits'" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="add" class="peer sr-only" checked>
                                <div class="text-center py-3 border border-gray-200 rounded-xl text-sm font-bold text-gray-600 peer-checked:border-green-500 peer-checked:text-green-600 peer-checked:bg-green-50 transition-all">
                                    <span class="material-symbols-rounded block mb-1">add_circle</span> Add Credits
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="deduct" class="peer sr-only">
                                <div class="text-center py-3 border border-gray-200 rounded-xl text-sm font-bold text-gray-600 peer-checked:border-red-500 peer-checked:text-red-600 peer-checked:bg-red-50 transition-all">
                                    <span class="material-symbols-rounded block mb-1">remove_circle</span> Deduct Credits
                                </div>
                            </label>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Amount</label>
                            <input type="number" name="amount" min="1" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-gray-200 rounded-xl p-3 font-bold text-slate-800 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Description / Reason</label>
                            <input type="text" name="description" placeholder="e.g. Bonus, Adjustment, Refund" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-gray-200 rounded-xl p-3 text-sm text-slate-800 dark:text-white">
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-xl font-bold mt-2 hover:bg-black transition-colors shadow-lg">Update Credits</button>
                    </form>
                </div>
            </template>
        </div>
    </div>

    <!-- Edit User Modal (NEW) -->
    <div x-data="{ openEditModal: false, editUser: null }" 
         @open-edit-modal.window="openEditModal = true; editUser = $event.detail" 
         x-show="openEditModal" 
         class="fixed inset-0 z-[70] flex items-center justify-center p-4" 
         style="display: none;" 
         x-transition.opacity>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openEditModal = false"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 dark:border-white/10 overflow-hidden animate-slide-up">
            <template x-if="editUser">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Edit User</h3>
                    <button @click="openEditModal = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <!-- Dynamic Form Action -->
                <form x-bind:action="'/admin/users/' + editUser.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-gray-50 dark:bg-[#1a0b0b] p-4 rounded-xl border border-gray-100 dark:border-white/5 mb-4 flex items-center gap-3">
                         <div class="size-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Editing</p>
                            <p class="font-bold text-gray-800 dark:text-white" x-text="editUser.name"></p>
                        </div>
                    </div>

                     <div>
                        <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">User Type</label>
                        <select name="role" x-model="editUser.role" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                            <option value="user">Regular Customer</option>
                            <option value="partner">Business Partner</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Name</label>
                            <input type="text" name="name" x-model="editUser.name" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Email</label>
                            <input type="email" name="email" x-model="editUser.email" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <!-- Partner Credits Field -->
                    <div x-show="editUser.role === 'partner'" x-transition>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Allotted Credits</label>
                         <div class="relative">
                            <input type="number" name="credits" x-model="editUser.credits" min="0" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 pl-10 focus:ring-primary focus:border-primary font-mono font-bold">
                            <span class="material-symbols-outlined absolute left-3 top-3 text-gray-400 text-[20px]">token</span>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">Directly modify the balance.</p>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.02]">Save Changes</button>
                    </div>
                </form>
            </div>
            </template>
        </div>
    </div>
</div>

<!-- AlpineJS is not included in layout yet, let's include it in layout or here -->


@endsection
