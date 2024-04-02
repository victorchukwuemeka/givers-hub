<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware('auth')->prefix('dashboard')->group(function () {

    // activation page
    Volt::route('/activation', 'pages.account.activation')
    ->name('activation');

    Route::middleware('account.activated')->group(function () {
    // dashboard
    Volt::route('/', 'pages.account.index')
        ->name('dashboard');
    // profile    
    Volt::route('/profile', 'pages.account.profile')
        ->name('profile');
    // upgrades    
    Volt::route('/upgrades', 'pages.account.upgrades')
        ->name('upgrades');
    // approve-upgrades    
    Volt::route('/approve-upgrades', 'pages.account.approve-upgrades')
        ->name('approve-upgrades');
    // affiliates    
    Volt::route('/affiliates', 'pages.account.affiliates')
        ->name('affiliates');
    // transactions    
    Volt::route('/transactions', 'pages.account.transactions')
    ->name('transactions');
    // wallet    
    Volt::route('/wallet', 'pages.account.wallet')
        ->name('wallet');
    // support    
    Volt::route('/support', 'pages.account.support')
        ->name('support');

    // profile    
    Volt::route('/profile', 'pages.account.profile')
    ->name('profile');
    // messages    
    Volt::route('/messages', 'pages.account.messages')
    ->name('messages');
   });


});
