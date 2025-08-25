<x-layout-app page-title="Recursos Humanos">

    <div class="w-100 p-4">

        <h3>Colaboradores - Recursos Humanos</h3>

        <hr>

        @if($colaborators->count() === 0)
        <p>Nenhum colaborador foi encontrado.</p>
        <div class="text-center my-5">
            <a href="{{route('colaborators.rh.new-colaborators')}}" class="btn btn-primary">Criar um novo colaborador</a>
        </div>

        @else

        <div class="mb-3">
            <a href="{{route('colaborators.rh.new-colaborators')}}" class="btn btn-primary">Criar um novo colaborador</a>
        </div>


        <table class="table" id="table">
            <thead class="table-dark">
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Role</th>
                <th>Salary</th>
                <th>Admission date</th>
                <th>City</th>
                <th></th>
            </thead>
            <tbody>

                @foreach($colaborators as $colaborator)
                <tr>
                    <td>{{$colaborator->name}}</td>
                    <td>{{$colaborator->email}}</td>
                    <td>
                        @empty($colaborator->email_verified_at)
                            <span class="badge bg-danger">No</span>
                        @else
                            <span class="badge bg-success">Yes</span>
                        @endempty
                    </td>
                    <td>{{$colaborator->role}}</td>

                    <td>{{$colaborator->detail->salary}} $</td>

                    <td>{{$colaborator->detail->admission_date}}</td>
                    <td>{{$colaborator->detail->city}}</td>

                    <td>
                        <div class="d-flex gap-3 justify-content-end">

                                @if(empty($colaborator->deleted_at))
                                    <a href="{{route('colaborators.rh.edit-colaborators', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-dark"><i
                                    class="fa-regular fa-pen-to-square me-2"></i>Edit</a>

                                    <a href="{{route('colaborators.rh.delete-colaborators', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-dark"><i
                                    class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                @else
                                    <a href="{{route('colaborators.rh.restore', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-dark"><i
                                    class="fa-solid fa-trash-arrow-up me-2"></i>Restore</a>
                                @endif
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @endif

    </div>

</x-layout-app>