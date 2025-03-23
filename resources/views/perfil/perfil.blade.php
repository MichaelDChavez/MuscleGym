@extends('layouts.layout')

@section('content')
<section >
    {{-- <div class="max-width">
        <div class="home-content"> --}}
            <div style="padding-inline: 60px">
                <div >
                    <div>
                        <div class="max-w-xl">
                            <div style="margin-top: 20px; border-radius: 20px; background-color:  rgba(241, 101, 46, 0.692); padding: 20px; border: 2px solid black">
                                <h2>Datos del Usuario</h2>
                                <b>Nombre:</b> {{Auth::user()->name}} <br>
                                <b>Correo:</b> {{Auth::user()->email}} <br>
                                @if (Auth::user()->rol == 1)
                                    <b>Rol:</b> Administrador <br>
                                @else
                                    <b>Rol:</b> Cliente <br>
                                @endif

                                @if (Auth::user()->rol == 2)
                                    <b>Membresia:</b> {{ $membresia }}<br>
                                @endif

                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->rol == 2 && !empty($historialMedico))
                        <div>
                            <div class="max-w-xl">
                                <div style="margin-top: 20px; width: 500px; border-radius: 20px; background-color:  rgba(224, 119, 27, 0.418); padding: 20px; border: 2px solid black">
                                    <h2>Historial Médico</h2>
                                    <div style="word-wrap: break-word;">
                                        <b>Motivo: </b> {{ $historialMedico->Historial_Medico }}
                                    </div> <br>
                                    @if ($historialMedico->Foto)
                                        <img src="{{ Storage::url($historialMedico->Foto) }}" alt="HisMed" width="200" style="margin-inline: auto" >
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <div >
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div >
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            {{-- </div>

        </div> --}}
    </div>
</section>
@endsection
