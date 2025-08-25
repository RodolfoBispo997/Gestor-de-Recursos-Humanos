<x-layout-guest page-title="Bem-Vindo">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                {{-- Logo --}}
                 <div class="text-center mb-5">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Logo" width="200px">
                </div>

                 {{-- Mensagem de bem-vindo --}}
                 <div class="card p-5 text-center">
                    <p>Bem-Vindo, <strong>{{$user->name}}</strong></p>
                    <p>Sua conta foi criado com sucesso!</p>
                    <p>Você pode <a href="{{route('login')}}">logar</a> na sua conta agora.</p>
                 </div>
            </div>
        </div>
    </div>
</x-layout-guest>