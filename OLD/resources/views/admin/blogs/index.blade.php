@extends('layouts.admin')

@section('title', 'Blog Post CRUD')
@section('page_title', 'Blog Post Manager')

@section('content')
<div class="space-y-6">
    <!-- Header Page Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 font-sans">Active Blog Posts</h3>
            <p class="text-sm text-slate-500 mt-1">Manage the blog posts displayed on the public landing page.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add New Post
        </a>
    </div>

    <!-- Alert Message -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-850 p-4 rounded-xl text-sm flex items-start">
            <svg class="mr-2.5 h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Listing Table -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        @if($blogs->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-slate-350" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <h3 class="mt-4 text-sm font-semibold text-slate-900">No blog posts found</h3>
                <p class="mt-1 text-xs text-slate-500">Get started by creating your first article.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Cover</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Title & Author</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Excerpt</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-36">Published Date</th>
                        <th class="relative px-6 py-3.5 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($blogs as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-12 w-20 rounded-lg overflow-hidden border border-slate-200 bg-slate-100 flex items-center justify-center">
                                    @if($item->image_url)
                                        <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}" class="object-cover h-full w-full">
                                    @else
                                        <!-- Fallback icon -->
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs sm:max-w-sm">
                                    <span class="text-sm font-semibold text-slate-900 block truncate">{{ $item->title }}</span>
                                    <span class="text-xs text-slate-400 block mt-0.5">By {{ $item->author }} | Category: <span class="font-semibold text-slate-650">{{ $item->category }}</span> | Slug: <span class="font-mono text-slate-500">{{ $item->slug }}</span></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-650 line-clamp-2 max-w-md leading-relaxed">{{ $item->excerpt }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs text-slate-600 block">
                                    {{ $item->published_at ? $item->published_at->format('M d, Y') : 'Draft' }}
                                </span>
                                @if($item->published_at && $item->published_at->isFuture())
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200 mt-1">Scheduled</span>
                                @elseif($item->published_at)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-250 mt-1">Published</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold space-x-3">
                                <a href="{{ route('admin.blogs.edit', $item->id) }}" class="text-[#008080] hover:text-[#006666] transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-650 hover:text-red-800 transition-colors focus:outline-none">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
