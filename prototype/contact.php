<?php
include 'includes/header.php';
?>
<main class="flex-grow flex flex-col lg:flex-row min-h-[calc(100vh-80px)]">
<div class="relative w-full lg:w-[40%] bg-surface-light dark:bg-surface-dark flex flex-col justify-center px-8 sm:px-12 lg:px-20 py-16 overflow-hidden transition-colors duration-300">
<div class="absolute inset-0 opacity-[0.05] dark:opacity-[0.03] pointer-events-none mix-blend-multiply dark:mix-blend-normal" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB-XQL4bxFKtLZ9MAt7uDEuxdslEaBNQcI4ly2OdzP4pEaocLZe8Tx0r5NDAeRj66axQ0yoyvtBRjzbQ_NC8NyLODGR9MVHOyYwIJmRqVktzCSDTz42u78q7DlblUjMYJ6YIvsmwHAt0OoNYvI-uIPoyWVq8EzDpLgPkWfIusABTIgrdAZwzL2k4I6BnWalOdi-5nj9BFQ87Cp40_r_fa7hHGxkagBGAsIl3EVCcMWjMI3Y9JdfE6NW8pF73Ax0xp5irp0S6z6zsmJT'); background-size: cover; background-position: center;">
</div>
<div class="relative z-10 max-w-lg">
<div class="mb-10">
<h5 class="text-primary font-bold tracking-widest uppercase text-xs mb-3">Get in Touch</h5>
<h1 class="text-gray-900 dark:text-white text-4xl lg:text-5xl font-bold leading-tight mb-4 transition-colors">We are here to help.</h1>
<p class="text-gray-600 dark:text-gray-400 text-lg font-light leading-relaxed transition-colors">
                    Planning a wedding can be stressful. Let us handle the details of your invitations so you can focus on the celebration.
                </p>
</div>
<div class="space-y-6 mb-12">
<div class="flex items-center gap-5 group cursor-pointer">
<div class="flex items-center justify-center rounded-xl bg-gray-100 dark:bg-[#482326] group-hover:bg-primary transition-colors shrink-0 size-12 text-gray-700 dark:text-white group-hover:text-white">
<span class="material-symbols-outlined">mail</span>
</div>
<div>
<p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider mb-0.5">Email Support</p>
<p class="text-gray-900 dark:text-white text-lg font-medium">support@vivahub.in</p>
</div>
</div>
</div>
</div>
</div>
<div class="relative w-full lg:w-[60%] flex items-center justify-center p-4 sm:p-8 lg:p-20 bg-gray-50 dark:bg-background-dark transition-colors duration-300">
<div class="glass-panel w-full max-w-2xl rounded-xl p-8 md:p-12 relative z-10 shadow-2xl transition-all duration-300">
<div class="flex justify-between items-start mb-10">
<div>
<h2 class="text-gray-900 dark:text-white text-3xl font-bold mb-2 transition-colors">Send us a Message</h2>
<p class="text-gray-600 dark:text-gray-300 font-light text-sm transition-colors">We typically reply within 24 hours.</p>
</div>
</div>
<form class="space-y-8" method="POST">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="relative z-0 w-full group">
<input class="floating-input block py-2.5 px-0 w-full text-base text-gray-900 dark:text-white bg-transparent border-0 border-b border-gray-400 dark:border-gray-500 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer transition-colors" id="name" name="name" placeholder=" " required="" type="text"/>
<label class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-85 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-85 peer-focus:-translate-y-6" for="name">Full Name</label>
</div>
<div class="relative z-0 w-full group">
<input class="floating-input block py-2.5 px-0 w-full text-base text-gray-900 dark:text-white bg-transparent border-0 border-b border-gray-400 dark:border-gray-500 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer transition-colors" id="email" name="email" placeholder=" " required="" type="email"/>
<label class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-85 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-85 peer-focus:-translate-y-6" for="email">Email Address</label>
</div>
</div>
<div class="relative z-0 w-full group">
<textarea class="floating-input block py-2.5 px-0 w-full text-base text-gray-900 dark:text-white bg-transparent border-0 border-b border-gray-400 dark:border-gray-500 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer resize-none transition-colors" id="message" name="message" placeholder=" " required="" rows="4"></textarea>
<label class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-85 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-85 peer-focus:-translate-y-6" for="message">How can we help you?</label>
</div>
<div class="pt-4 flex items-center justify-between">
<button class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg shadow-lg shadow-primary/30 dark:shadow-red-900/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2" type="submit">
<span>Submit Inquiry</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
</form>
</div>
</div>
</main>
<?php
include 'includes/footer.php';
?>
