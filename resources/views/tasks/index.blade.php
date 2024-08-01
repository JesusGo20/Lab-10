<x-app-layout>
    <div class="container py-3">
        <main>
            <h2 class="display-6 text-center mb-4">Tareas</h2>
            <a href="/tasks/create" class="btn btn-outline-primary mb-3">Crear</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Prioridad</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Etiquetas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($tasks as $task)
                            @can('autorized',$task)
                                <tr class="{{ $task->completed ? 'table-success' : '' }}">
                                    <th scope="row">{{ $task->id }}</th>
                                    <td><a href="/tasks/{{ $task->id }}">{{ $task->name }}</a></td>
                                    <td>{{ $task->description }}</td>
                                    <td
                                        style="color:
                                    @if ($task->priority->id == 1) red
                                    @elseif ($task->priority->id == 2)
                                        yellow
                                    @elseif ($task->priority->id == 3)
                                        green @endif">
                                        {{ $task->priority->name }}
                                    </td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>
                                        @foreach ($task->labels as $label)
                                            <span class="badge bg-primary">{{ $label->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($task->completed)
                                            <span class="badge bg-success">Completada</span>
                                        @else
                                            <form action="/tasks/{{ $task->id }}/complete" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary btn-sm">Completar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endcan
                            @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
