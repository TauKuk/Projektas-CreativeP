@extends('layouts.app')

@section('content')

    @if ($user->id == Auth::user()->id)
    <main> 
      <div class="container">
            <div class="row">
                <div class="col-md-6 flex-shrink-1"><h1>Renginiai, sukurti {{ $user->name }}</h1></div>

                <div class="col-md-6 d-flex justify-content-end flex-shrink-1" class="mb-0">
                    <a href="/{{ $user->id }}/events/create"><h1>Sukurti renginį</h1></a>
                </div>
            </div>

            @forelse($events as $index => $event)

            <a href="/{{ $user->id }}/events/{{ $event->id }}" id="link" class="draggable" draggable="true"> 
                @include('event.display_single')
            </a>

            @empty

            <p class="border-top border-dark pt-3 mb-3">Nėra sukurtų renginių</p>

            @endforelse
        </div>  
    </main>

    <script>
        const draggables = document.querySelectorAll('.draggable')
        const container = document.querySelector('.container')

        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                draggable.classList.add('dragging')
            })

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('dragging')
            })
        })

        container.addEventListener('dragover', e => {
            e.preventDefault()
            const afterElement = getDragAfterElement(container, e.clientY)
            const draggable = document.querySelector('.dragging')
            if (afterElement == null) {
                container.appendChild(draggable)
            } else {
                container.insertBefore(draggable, afterElement)
            }
        })

        function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect()
            const offset = y - box.top - box.height / 2
            if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child }
            } else {
            return closest
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element
        }
    </script>
    
    @endif
@endsection
