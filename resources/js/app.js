import './bootstrap';
import 'flowbite';

document.addEventListener("livewire:navigated", () => {
    // Reinitialize Flowbite components on each wire:navigate page reload
    initFlowbite();
});

