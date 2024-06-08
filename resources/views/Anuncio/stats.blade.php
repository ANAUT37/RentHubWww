@extends('Layouts.main')
@section('title', 'RêntHûb.es | Estadísticas')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
        <h1 class="text-2xl font-bold">Estadísticas</h1>
        <div role="status" id="status" class="absolute top-1/4 right-1/2 z-10">
            <svg aria-hidden="true" class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        <div id="content" class="hidden justify-between">
            <div>
                <div
                    class=" w-full rounded-md h-28 flex justify-start items-center p-2 bg-gray-100 cursor-pointer gap-2 hover:bg-gray-200">
                    <img src="https://images.livspace-cdn.com/plain/https://jumanji.livspace-cdn.com/magazine/wp-content/uploads/sites/3/2021/10/18115838/modern-house-design.jpg"
                        alt="" class="w-28 h-24 border-gray-100 border rounded-md object-fit">
                    <div class="flex flex-col items-start justify-between">
                        <p class="font-bold text-xl">{{ $anuncioData->title }}</p>
                        <p class="font-bold text-xl">{{ $anuncioData->created_at }}</p>
                    </div>
                </div>
                <div class="flex justify-between mt-2 mb-2 flex-col lg:flex-row gap-2">
                    <div class="flex gap-2 overflow-x-scroll lg:overflow-x-auto">
                        <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Visitas únicas</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                            Impresiones</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>
                            Veces guardado</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                            Veces compartido</button>
                    </div>
                    <div class="">
                        <select name="timeline" id="timeline"
                            class="rounded-md hover:bg-gray-200 cursor-pointer bg-gray-100 w-full lg:auto">
                            <option value="day">Últimas 24 horas</option>
                            <option value="week">Última semana</option>
                            <option value="month">Últimos 30 días</option>
                            <option value="year">Últimos 12 meses</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="container flex-col gap-4 w-full mx-auto pt-2 flex justify-center mb-4 z-10">
                <div class="w-full min-h-full"><canvas id="acquisitions"></canvas></div>
            </div>
            <div>
                <div>
                    <p class="text-2xl font-bold">Quién te ve</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">Desde donde te ven</p>
                </div>
            </div>
            <br>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timeline = document.getElementById('timeline');
            const ctx = document.getElementById('acquisitions').getContext('2d');
            let chart;

            timeline.addEventListener('change', function() {
                const value = timeline.value;
                const anuncioId = '{{ $real_anuncio_id }}'; // Replace with the actual anuncio_id
                const action = 'view'; // Replace with the actual action

                const url = `/anuncio/stats/${anuncioId}/${action}/${value}`;

                fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json(); // Convert the response to JSON
                        } else {
                            throw new Error('Error en la solicitud');
                        }
                    })
                    .then(data => {
                        console.log(data); // Log the data to check the structure
                        if (Array.isArray(data)) {
                            updateChart(data); // Call a function to update the chart with the new data
                        } else {
                            console.error('Response is not an array:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error); // Handle any errors
                    });
            });

            function updateChart(data) {
                const labels = data.map(row => {
                    if (row.day) {
                        return row.day;
                    } else if (row.month) {
                        return row.month;
                    } else if (row.hour) {
                        return row.hour;
                    }
                    return '';
                });

                const counts = data.map(row => row.count);

                if (chart) {
                    chart.destroy(); // Destroy the old chart before creating a new one
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Visitas',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
    <script src="
                            https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js
                            "></script>
    <script src="https://media.renthub.es/js/loader.js"></script>

@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
