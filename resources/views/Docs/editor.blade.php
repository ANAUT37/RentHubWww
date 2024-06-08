@extends('Layouts.top')
@section('title', 'RêntHûb.es | Docs')

@section('header')
    @include('Headers.sessioned_home')

@endsection

@section('top')
    @php
        use App\Models\DocParticipant;
        use App\Models\Doc;
        use App\Models\Particular;
        $documentId = Doc::getIdByDisplayId($display_id);
        $documentData = Doc::getById($display_id);
        $listParticipants = DocParticipant::getDocParticipants($documentId);
        $userRole = DocParticipant::isUserAbled($documentId, Auth::user()->id);
    @endphp
    <div class="sticky container mx-auto px-4 " style="backdrop-filter: blur(8px);">
        <div class="container lg:w-2/3 mx-auto border-b-gray-200 border-b pb-4">
            <br>
            <div class="flex justify-between">
                <input type="text" placeholder="Título del documento" value="{{ $documentData->title }}"
                    class="w-full lg:w-96 sm:w-64 px-2 py-1 border border-gray-300 rounded-md sm:rounded-l-md">
                <div class="relative flex justify-end align-middle items-center gap-4">
                    <div class="">
                        <div id="savingDocument" class="flex gap-2 items-center align-middle hidden">
                            <div role="status" class="text-center flex justify-center">
                                <svg aria-hidden="true"
                                    class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
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
                            <p>Guardando...</p>
                        </div>
                        <div id="savedDocument" class="flex gap-2 items-center align-middle">
                            <div role="status" class="text-center flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </div>
                            <p>Guardado</p>
                        </div>
                    </div>
                    <button id="participantsButton"
                        class=" bg-gray-100  px-3 py-1 rounded-md sm:rounded-r-md flex
                      hover:bg-gray-200   gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <p>Participantes</p>
                    </button>
                </div>
            </div>
            <br>
        </div>
    </div>

@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/editor.css') }}">
    <style>
        .ck .ck-content {
            padding-left: 20%;
            padding-right: 20%;
            min-height: 70vh;
            max-height: 70vh;
            overscroll-behavior-y: inherit;
        }
        .ck-content{
            background-color: red;
        }
        body {
            overflow-y: hidden;
        }
    </style>
    <div id="editor" class="h-screen">

    </div>
    <div id="participantsDisplay" class="fixed top-1/4 left-0 w-full h-auto flex justify-center items-center z-30 hidden">
        <div id="participantsDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
        <div id="newDocSelectorDisplay"
            class="bg-gray-100 lg:w-2/6 lg:h-1/4 h-2/5 mx-auto w-5/6 rounded-md border border-gray-200 flex p-5 gap-4 flex-col"
            style="backdrop-filter: blur(10px);">
            <p class="text-2xl font-bold">Participantes</p>
            <p>Lista de participantes y sus permisos para ver o editar este documento</p>
            <?php
            if($userRole===2){
            ?>
            <div class="border-b border-gray-100 pb-2">
                <div class="flex ">
                    <input type="email" id="shareEmail" placeholder="Email de la persona a compartir"
                        class="w-full px-2 py-1 border border-gray-300 rounded-l-md sm:rounded-l-md">
                    <select name="role" id="shareRole" class="cursor-pointer p-1 min-w-24 h-auto">
                        <option value="editor">Editor</option>
                        <option value="lector">Lector</option>
                    </select>
                    <button id="shareRoleButton"
                        class="bg-white border w-24 text-center border-gray-300 text-black px-3 py-1 rounded-r-md  flex
                  hover:bg-gray-600 hover:text-white hover:border-gray-600 gap-2">Compartir</button>
                </div>
                <p class="text-md hidden" id="shareResponse">Resonse message</p>
            </div>
            <?php
                }
                ?>
            @foreach ($listParticipants as $participant)
                @php
                    $userData = Particular::getParticularData($participant->user_id);
                @endphp
                <div class="w-100 hover:bg-gray-200 hover:cursor-pointer flex rounded-lg justify-between">
                    <div class="p-4 min-w-16">
                        <img class="profile-button rounded-full h-10 w-10 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic(Auth::user()->profile_pic_url) }}" alt="">
                    </div>
                    <div class="w-full">
                        <div class="max-w-lg p-4 rounded-lg ">
                            <p class="text-lg"><b>{{ $userData->name }} {{ $userData->surname }}
                                    @php
                                        if ($userData->user_id === Auth::user()->id) {
                                            echo '(Tú)';
                                        }
                                    @endphp
                                </b></p>
                            <p class="text-sm">
                                @php
                                    echo DocParticipant::formatDocRole($participant->owner, $participant->editable);
                                @endphp
                            </p>
                        </div>
                    </div>
                    <?php
                        if($userRole===2){
                            if($userData->user_id != Auth::user()->id){
                    ?>
                    <div class="max-w-lg p-4 rounded-lg ">
                        <select name="role" id="{{ $userData->user_id }}" class="cursor-pointer roleSelectors">
                            <option value="owner">Propietario</option>
                            <option value="editor">Editor</option>
                            <option value="lector">Lector</option>
                            <option value="delete">Eliminar</option>
                        </select>
                    </div>
                    <?php
                        }
                        }
                        ?>
                </div>
            @endforeach
            <?php
            if($userRole===2){
                ?>
            <button id="saveRolesButton"
                class="bg-white border w-24 text-center border-gray-300 text-black px-3 py-1 rounded-md sm:rounded-r-md flex
              hover:bg-gray-600 hover:text-white hover:border-gray-600 gap-2">Guardar</button>
            <?php
            }
        ?>
        </div>
    </div>
    <script>
        const savingDocument = document.getElementById('savingDocument');
        const savedDocument = document.getElementById('savedDocument');

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.setData("{{ $documentData->content }}");


                setInterval(() => {
                    savingDocument.classList.toggle('hidden');
                    savedDocument.classList.toggle('hidden');

                    const editorContent = editor.getData();

                    fetch('/docs/{{ $display_id }}/save', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                content: editorContent
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === "saved") {
                                savingDocument.classList.toggle('hidden');
                                savedDocument.classList.toggle('hidden');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }, 60000);
            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <script>
        const saveRolesButton = document.getElementById('saveRolesButton');
        if (saveRolesButton) {
            saveRolesButton.addEventListener('click', function() {
                const rolesData = {};
                const roleSelectors = document.querySelectorAll('.roleSelectors');
                roleSelectors.forEach(selector => {
                    rolesData[selector.id] = selector.value;
                });
                fetch('/docs/{{ $display_id }}/saveRoles', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(rolesData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        }
    </script>
    <?php
    if($userRole===2){
    ?>
    <script>
        const shareRoleButton = document.getElementById('shareRoleButton');
        const shareResponse = document.getElementById('shareResponse');
        if (shareRoleButton) {
            shareRoleButton.addEventListener('click', function() {
                const rolesData = {};
                const shareRole = document.getElementById('shareRole').value;
                rolesData['shareRole'] = shareRole;
                const shareEmail = document.getElementById('shareEmail').value;
                rolesData['shareEmail'] = shareEmail;

                fetch('/docs/{{ $display_id }}/shareRole', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(rolesData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        shareResponse.classList.toggle('hidden');
                        shareResponse.textContent = data.message;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        }
    </script>


    <?php
    }
    ?>
    <script>
        const participantsButton = document.getElementById('participantsButton');
        const participantsDisplay = document.getElementById('participantsDisplay');
        const participantsDisplayBackdrop = document.getElementById('participantsDisplayBackdrop');

        participantsButton.addEventListener('click', function() {
            participantsDisplay.classList.toggle('hidden');
            participantsDisplayBackdrop.classList.toggle(
                'hidden');
        });

        participantsDisplayBackdrop.addEventListener('click', function() {
            participantsDisplay.classList.add('hidden');
            participantsDisplayBackdrop.classList.add(
                'hidden');
        });
    </script>
@endsection
@section('footer')
@endsection
