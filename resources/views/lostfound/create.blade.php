@extends('layouts.lostfound')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 text-center">
            <div class="text-4xl mb-3">📌</div>
            <h1 class="text-3xl font-extrabold text-gray-900">Pin It on the Board</h1>
            <p class="text-gray-500 mt-1">Share with your neighbors — someone might be able to help!</p>
        </div>

        <form method="POST" action="{{ route('items.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl shadow-sm border-2 border-amber-100 p-6">
                <label class="block text-sm font-bold text-gray-700 mb-4">What's happening?</label>

                <div class="grid grid-cols-2 gap-4">
                    <label class="flex flex-col items-center gap-3 p-5 rounded-2xl border-2 border-rose-200 hover:bg-rose-50 cursor-pointer">
                        <input type="radio" name="type" value="lost" class="hidden" checked>
                        <div class="text-4xl">⚠️</div>
                        <span class="font-extrabold text-lg text-rose-700">I Lost Something</span>
                        <span class="text-xs text-gray-400">Ask neighbors to keep an eye out</span>
                    </label>

                    <label class="flex flex-col items-center gap-3 p-5 rounded-2xl border-2 border-emerald-200 hover:bg-emerald-50 cursor-pointer">
                        <input type="radio" name="type" value="found" class="hidden">
                        <div class="text-4xl">🔍</div>
                        <span class="font-extrabold text-lg text-emerald-700">I Found Something</span>
                        <span class="text-xs text-gray-400">Help return it to its owner</span>
                    </label>
                </div>

                @error('type') <p class="text-rose-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 space-y-5">
                <h2 class="text-lg font-extrabold text-gray-900">📝 Item Details</h2>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">What is it? <span class="text-rose-500">*</span></label>
                    <input name="title" value="{{ old('title') }}" placeholder="e.g., Black Leather Wallet" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tell us more <span class="text-rose-500">*</span></label>
                    <textarea name="description" rows="4" placeholder="Describe it — color, size, brand, unique marks..." class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white">{{ old('description') }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Category</label>
                        <select name="category" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                            @foreach($categories as $key => $label)
                                <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Where? <span class="text-rose-500">*</span></label>
                    <input name="location" value="{{ old('location') }}" placeholder="e.g., Community Park, Library 2nd floor" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                    @error('location') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">🎁 Offering a reward? Optional</label>
                    <input name="reward" value="{{ old('reward') }}" placeholder="e.g., $50, Homemade cookies" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6 space-y-5">
                <h2 class="text-lg font-extrabold text-gray-900">🤝 How Can Neighbors Reach You?</h2>

                <input name="contact_name" value="{{ old('contact_name') }}" placeholder="Your Name" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                @error('contact_name') <p class="text-rose-500 text-xs">{{ $message }}</p> @enderror

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="email" name="contact_email" value="{{ old('contact_email') }}" placeholder="you@email.com" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                    <input name="contact_phone" value="{{ old('contact_phone') }}" placeholder="(555) 123-4567" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50">
                </div>

                @error('contact_email') <p class="text-rose-500 text-xs">{{ $message }}</p> @enderror
                @error('contact_phone') <p class="text-rose-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('board') }}" class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl font-bold">Cancel</a>
                <button class="px-8 py-3 rounded-xl font-extrabold text-white bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg">
                    💚 Post to Community Board
                </button>
            </div>
        </form>
    </div>
</div>
@endsection