@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in" x-data="{ openCreateModal: false }">
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
                                <span class="px-2 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 capitalize">{{ $user->role }}</span>
                            </td>
                            <td class="p-4 text-gray-600 dark:text-gray-400 text-sm">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Active</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($user->role !== 'admin')
                                    <!-- Impersonate Button -->
                                    <button onclick="if(confirm('Login as this user?')) document.getElementById('impersonate-form-{{ $user->id }}').submit()" class="text-gray-400 hover:text-primary transition-colors" title="Impersonate">
                                        <span class="material-symbols-outlined text-[20px]">login</span>
                                    </button>
                                    <form id="impersonate-form-{{ $user->id }}" action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                    @endif
                                    
                                    <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ $user->id }}').submit()">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                     <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                    
                                    <!-- Edit Button (trigger modal via event) -->
                                    <button @click="$dispatch('open-edit-modal', {id: {{ $user->id }}, name: '{{ $user->name }}', email: '{{ $user->email }}', role: '{{ $user->role }}'})" class="text-gray-400 hover:text-slate-800 dark:hover:text-white transition-colors" title="Edit">
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
</div>

<!-- AlpineJS is not included in layout yet, let's include it in layout or here -->
<script src="//unpkg.com/alpinejs" defer></script>

@endsection
