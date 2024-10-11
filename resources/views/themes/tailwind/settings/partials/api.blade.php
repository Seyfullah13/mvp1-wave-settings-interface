@extends('theme::layouts.base')


<div class="mt-20">
    <h1 class="text-left text-2xl font-bold mb-4 mt-4">API Settings</h1>

    <!-- API Keys Card -->
    <div class="p-6">
        <!-- API Keys Livewire Component -->
        @livewire('api-keys')
    </div>
</div>