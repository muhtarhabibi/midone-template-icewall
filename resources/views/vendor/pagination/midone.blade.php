@if ($paginator->hasPages())
    <div class="flex text-sm justify-between flex-1 sm:hidden">
        <nav class="w-full sm:w-auto sm:mr-auto" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg> Previous
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg> Previous
                        </a>
                    </li>
                @endif
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> Next
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> Next
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <div class="hidden text-sm sm:flex-1 sm:flex sm:items-center sm:justify-between p-2">
        {{-- <div>
            <p class="text-sm text-gray-700 leading-5">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div> --}}

        <div>
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    {{-- <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li> --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item">
                            <a class="page-link" disabled>
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <li class="page-item active">
                                <a class="page-link" disabled>{{ $element }}</a>
                            </li>
                        @endif


                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active">
                                        <a class="page-link" disabled>{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
@endif
