<div class=" fixed  h-full  flex bg-white w-full overflow-hidden inset-0 lg:top-16  lg:inset-x-2 ">

    <div class="hidden lg:flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full ">
        <livewire:chat.chat-list :selectedConversation="$selectedConversation" :query="$query">
    </div>

    <div class="grid w-full h-full relative overflow-y-auto" style="contain:content">

        <livewire:chat.chat-box :selectedConversation="$selectedConversation">

    </div>
    <div class="hidden lg:flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full ">
        <livewire:chat.chat-list :selectedConversation="$selectedConversation" :query="$query">
    </div>


</div>
