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
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">User</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Role</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Email</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <!-- We will use JS fetch for data or Blade layout. For now, assuming JS loading via controller API or blade injection. 
                     Since we passed JSON response in controller, let's switch controller to return VIEW with data, or use AlpineJS fetch.
                     For simplicity and Laravel best practice, the controller should return VIEW. I need to fix Controller later properly. 
                     But for this step, I'll use AlpineJS to fetch from the API endpoint I created.
                -->
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center font-bold text-xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="text-slate-800 dark:text-white text-sm font-medium">{{ $user->name }}</span>
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
                            <td class="p-4 text-gray-600 dark:text-gray-400 text-sm">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Active</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($user->role !== 'admin')
                                    <!-- Impersonate Button -->
                                    <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-primary transition-colors" title="Impersonate">
                                            <span class="material-symbols-outlined text-[20px]">login</span>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" title="Delete User">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                    
                                    @endif
                                    
                                    <!-- Edit Button (trigger modal via event) -->
                                    <button @click="$dispatch('open-edit-modal', {id: {{ $user->id }}, name: '{{ $user->name }}', email: '{{ $user->email }}', role: '{{ $user->role }}', credits: {{ $user->partnerDetails->credits ?? 0 }} })" class="text-gray-400 hover:text-slate-800 dark:hover:text-white transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-4 text-center text-gray-500">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $users->links() }}
            </div>
            </table>
        </div>
    </div>

    <!-- Manage Credits Modal -->
    <div x-show="openCreditModal" class="fixed inset-0 z-[75] flex items-center justify-center p-4" style="display: none;" x-transition.opacity>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openCreditModal = false"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-xl border border-gray-100 dark:border-white/10 overflow-hidden animate-slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Manage Credits</h3>
                    <button @click="openCreditModal = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <div class="bg-blue-50 text-blue-800 text-sm p-3 rounded-lg mb-4">
                    Managing credits for <span class="font-bold" x-text="selectedUser?.name"></span>
                </div>
                
                <form x-bind:action="'/admin/users/' + selectedUser?.id + '/credits'" method="POST" class="space-y-4">
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
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Edit User</h3>
                    <button @click="openEditModal = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <!-- Dynamic Form Action -->
                <form x-bind:action="'/admin/users/' + editUser?.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-gray-50 dark:bg-[#1a0b0b] p-4 rounded-xl border border-gray-100 dark:border-white/5 mb-4 flex items-center gap-3">
                         <div class="size-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Editing</p>
                            <p class="font-bold text-gray-800 dark:text-white" x-text="editUser?.name"></p>
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
        </div>
    </div>
</div>

<!-- AlpineJS is not included in layout yet, let's include it in layout or here -->
<script src="//unpkg.com/alpinejs" defer></script>

@endsection
