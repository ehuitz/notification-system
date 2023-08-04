@extends('layouts.guest')
<div class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-indigo-600">Notification System</p>
      <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ $subject }}</h1>
      <p class="mt-6 text-2xl leading-7 text-gray-600">{{ $content }}</p>
    </div>
  </div>
