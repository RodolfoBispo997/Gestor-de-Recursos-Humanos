<x-layout-app page-title="Editar Colaborador - RH">

    <div class="w-100 p-4">

        <h3>Editar Colaborador - RH</h3>

        <hr>

        <form action="{{ route('colaborators.rh.update-colaborators') }}" method="post">

            @csrf

            <div class="d-flex gap-3">
                <p>Nome do Colaborador: <strong>{{$colaborator->name}}</strong></p>
                <p>Email do Colaborador: <strong>{{$colaborator->email}}</strong></p>
            </div>

            <hr>

            <input type="hidden" name="user_id" value="{{$colaborator->id}}">

            <div class="container-fluid">
                <div class="row gap-3">

                    {{-- user --}}
                    <div class="col border border-black p-4">

                        
                        <div class="mb-3">
                            <label for="salary" class="form-label">salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" step=".01" placeholder="0,00" value="{{ old('salary', $colaborator->detail->salary) }}">
                            @error('salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date', $colaborator->detail->admission_date) }}">
                            @error('admission_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="select_department">Department</label>
                                    <select class="form-select" id="select_department" name="select_department">
                                        @foreach ($departments as $department)
                                            @if($department->id == 2)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('select_department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{ route('departments.new-department') }}"
                                        class="btn btn-outline-primary mt-4"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div> --}}

                        <p class="mb-3">Profile: <strong>Human Resources</strong></p>

                    </div>

                </div>

                <div class="mt-3">
                    <a href="{{ route('colaborators.rh-users') }}" class="btn btn-outline-danger me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update colaborator</button>
                </div>

            </div>

        </form>

    </div>

</x-layout-app>
