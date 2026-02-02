<div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 relative overflow-hidden group hover:border-primary transition-all shadow-soft-light card-hover flex flex-col h-full">
    <div class="absolute top-0 right-0 bg-gray-100 dark:bg-[#1a0b0b] px-3 py-1.5 rounded-bl-xl text-[10px] font-bold text-gray-500 uppercase tracking-wider">
        {{ $plan->type }}
    </div>
    <h3 class="text-xl font-black text-slate-800 dark:text-white mb-1 tracking-tight">{{ $plan->name }}</h3>
    <p class="text-xs text-accent-gold uppercase font-bold tracking-wider mb-4">Validity: {{ $plan->validity }}</p>
    <div class="flex items-baseline gap-1 mb-6">
        <span class="text-3xl font-black text-slate-800 dark:text-white">₹{{ number_format($plan->price) }}</span>
    </div>
    <ul class="space-y-3 mb-6 flex-1">
        @if(is_array($plan->features))
            @foreach($plan->features as $feature)
                <li class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                    <div class="min-w-4 pt-0.5"><span class="material-symbols-outlined text-green-500 text-sm font-bold">check</span></div>
                    <span class="leading-tight">{{ $feature }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    
    <div class="mt-auto pt-4 flex gap-2">
        <button onclick='openEditPlanModal(@json($plan))' 
        class="flex-1 py-2.5 rounded-xl border border-border-light dark:border-border-dark text-slate-700 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors text-sm font-medium">
            Edit
        </button>
        <form id="delete-plan-{{ $plan->id }}" action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST">
             @csrf @method('DELETE')
            <button type="button" @click="$dispatch('confirm-action', { 
                title: 'Delete Plan?', 
                message: 'Are you sure you want to delete {{ addslashes($plan->name) }}?', 
                formId: 'delete-plan-{{ $plan->id }}' 
            })" class="size-10 flex items-center justify-center bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20 text-red-500 rounded-xl transition-colors">
                <span class="material-symbols-outlined text-sm">delete</span>
            </button>
        </form>
    </div>
</div>
