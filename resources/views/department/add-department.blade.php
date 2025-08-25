<x-layout-app page-title="Novo Departamento">
    <div class="w-25 p-4">

        <h3>New department</h3>

        <hr>

        <form action="{{route('departments.create-department')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Departamento</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{route('departments')}}" class="btn btn-outline-danger me-3">Cancelar</a>
                <button type="submit" class="btn btn-primary">Create department</button>
            </div>

        </form>

    </div>
</x-layout-app>