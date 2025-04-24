@extends('layouts.app')

@section('content')
    <div class="container py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-center text-white mb-10 drop-shadow">📰 Publicaciones Recientes</h1>

            <div class="flex justify-center mb-10">
                <a href="{{ route('publicaciones.create') }}"
                    class="bg-gradient-to-r from-green-400 to-green-500 hover:from-yellow-500 hover:to-blue-600 text-black font-bold px-6 py-3 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                    + Crear una nueva Publicación
                </a>
            </div>

            @if (session('success'))
                <div id="success-message"
                    class="max-w-xl mx-auto bg-green-600 text-white font-medium px-6 py-4 rounded-lg text-center mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div id="error-message"
                    class="max-w-xl mx-auto bg-red-600 text-white font-medium px-6 py-4 rounded-lg text-center mb-6 shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if ($publicaciones && $publicaciones->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($publicaciones as $publicacion)
                        <div
                            class="bg-gradient-to-br from-gray-800 via-gray-900 to-black rounded-xl shadow-xl hover:shadow-2xl transition p-6 flex flex-col justify-between border border-gray-700">
                            <div>
                                <div class="text-sm text-gray-400 mb-2">
                                    <span class="text-white font-bold">{{ $publicacion->user->name }}</span> publicó:
                                </div>
                                <h2 class="text-2xl font-semibold text-yellow-400 mb-2">{{ $publicacion->titulo }}</h2>
                                <p class="text-gray-300 text-sm mb-4">{{ $publicacion->contenido }}</p>
                                <p class="text-xs text-gray-500 italic">🕒
                                    {{ $publicacion->created_at->format('d M Y - H:i') }}</p>
                            </div>

                            <div class="flex justify-center mt-6 gap-3">
                                <a href="{{ route('publicaciones.show', $publicacion->id_publicacion) }}"
                                    class="bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-green-500 transition shadow">
                                    📄 Ver
                                </a>
                                @if ($publicacion->id_usuario == Auth::id())
                                    <a href="{{ route('publicaciones.edit', $publicacion->id_publicacion) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600 transition shadow">
                                        🖋️ Editar
                                    </a>
                                    <form action="{{ route('publicaciones.destroy', $publicacion->id_publicacion) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Estás seguro que deseas eliminar esta publicación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition shadow">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center mt-20">
                    <div class="inline-block bg-gray-800 text-gray-300 px-8 py-6 rounded-xl shadow-lg">
                        <p class="text-xl">😕 Aún no hay publicaciones disponibles.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/Duracion_mensaje.js')
@endpush
