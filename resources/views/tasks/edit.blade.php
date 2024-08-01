<x-app-layout>
    <div class="container py-3">
        <h1 class="mb-4">Editar la tarea: {{ $task->name }}</h1>
        <hr>
        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $task->name }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{ $task->description }}</textarea>
            </div>
            <div>
                <section>
                    <label for="status" class="form-label">Prioridad</label>
                    <select class="form-select" name="priority" id="priority">
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </section>
            </div>
            <div>
                <label for="lang">Etiquetas</label>
                <select name="labels[]" id="labels" class="form-select" id="labelsEdit" multiple>
                    @foreach ($labels as $label)
                        <option value="{{ $label->id }}"
                            @foreach ($task->labels as $labelEdit) 
                            @if ($label->id == $labelEdit->id) selected @endif @endforeach>
                            {{ $label->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        </form>
    </div>
</x-app-layout>
