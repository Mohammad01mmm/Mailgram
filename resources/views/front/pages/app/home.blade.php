@push('style')
    <style>
        .hidden_scroll::-webkit-scrollbar {
            width: 0px !important;
        }

        .custom-scrollbar-sidebar::-webkit-scrollbar {
            width: .375rem;
        }

        .custom-scrollbar-sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .custom-scrollbar-sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
<div class="w-full h-full bg-repeat flex" style="background: url('images/bg-pattern.png'); background-size: 500px auto;">
    <div class="w-1/4 min-h-full bg-[#212121] border-r border-r-[#00000057]">
        <div
            class="w-full flex items-center justify-between sticky top-0 bg-[#212121] border-b border-b-[#00000057] shadow-lg py-4 px-4">
            <div x-data="{ open: false }" class="relative">
                <div @click="open = !open"
                    class="rounded-circle mr-1 p-2 rounded-full size-10 text-center hover:bg-[#2b2b2b] cursor-pointer">
                    <i class='bx bx-menu text-2xl text-[#aaaaaa]'></i>
                </div>
                <div x-show="open" @click.outside="open = false"
                    class="absolute top-14 left-7 w-64 max-h-80 backdrop-blur-[10px] overflow-y-auto custom-scrollbar-sidebar shadow-lg text-white rounded-lg p-2">
                    <div class="hover:bg-[#2b2b2b] p-3 px-5 rounded-md my-1 cursor-pointer flex items-center">
                        <i class='bx bx-plus-circle mr-3 font-bold text-xl'></i> Create Group
                    </div>
                </div>
            </div>

            <div class="w-full flex items-center flex-row-reverse">
                <input type="text" placeholder=" Search "
                    class="peer text-white p-2.5 bg-[#2c2c2c] w-full rounded-r-full focus:outline-none focus:border focus:border-l-0 focus:border-[#36ace9] focus:bg-[#212121]">
                <div
                    class="text-xl bg-[#2c2c2c] rounded-l-full py-2 px-3 peer-focus:border-r-0 peer-focus:border peer-focus:border-[#36ace9] text-[#aaaaaa] peer-focus:text-[#36ace9] peer-focus:bg-[#212121]">
                    <i class='bx bx-search'></i>
                </div>
            </div>
        </div>

        <div class="h-[630px] w-full overflow-x px-4 py-1 custom-scrollbar-sidebar" wire:poll.1s="loadMessages">

            @foreach ($users as $user)
                <div wire:click="selectUser({{ $user->id }})"
                    class="w-full h-16 rounded-lg my-2 flex items-center p-2 hover:bg-[#2c2c2c] cursor-pointer
                @if ($selectedUserId == $user->id) bg-[#766ac8] hover:bg-[#766ac8] @endif">
                    <div class="bg-[#212121] rounded-full size-14 text-white flex items-center justify-center border">
                        <img class="w-full" src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ $user->uname }}"
                            alt="avatar" />
                    </div>
                    <div class="ml-2 text-white">
                        <div class="font-bold text-xl">
                            <span class="hidden xl:block">{{ str($user->uname)->limit(13) }}</span>
                            <span class="hidden lg:block xl:hidden">{{ str($user->uname)->limit(5) }}</span>
                            <span class="hidden md:block lg:hidden">{{ str($user->uname)->limit(3) }}</span>
                            <span class="hidden sm:block md:hidden">{{ str($user->uname)->limit(2) }}</span>
                            <span class="block sm:hidden">{{ str($user->uname)->limit(1) }}</span>
                        </div>
                        <small class="block text-[#ffffffae]">
                            {{ optional($user->messages->last())->message ?? '' }}
                        </small>
                    </div>
                    {{-- <div
                        class="ml-auto mr-3 rounded-full px-[0.437rem] min-w-[1.5rem] min-h-[1.5rem] text-center bg-[rgb(113,117,121)] leading-6 text-white font-bold border border-[#4e5257]">
                        99+
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-3/4 h-full">
        @if ($selectedUser)
            <div>
                <div
                    class="w-full flex items-center p-2 px-9 cursor-pointer bg-[#212121] border-b border-b-[#00000057] sticky top-0 shadow-lg">
                    <div class="bg-[#212121] rounded-full size-14 text-white flex items-center justify-center border">
                        <img class="w-full"
                            src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ $selectedUser->uname }}"
                            alt="avatar" />
                    </div>
                    <div class="ml-2 text-white">
                        <div class="font-bold text-xl"> {{ $selectedUser->uname }} </div>
                        <small> online </small>
                    </div>
                </div>
                <div class="w-full mx-auto ">
                    <div class="w-full h-[550px] overflow-y-scroll custom-scrollbar-sidebar">
                        <div class="w-2/3 mx-auto h-full text-white flex flex-col-reverse overflow-auto hidden_scroll"
                            wire:poll.1s="loadMessages">

                            @foreach ($messages as $message)
                                <div class="p-2 rounded w-fit max-w-80 my-2
                                    {{ $message->sender_id == auth()->id() ? 'bg-[#766ac8] self-end' : 'bg-[#212121] self-start' }}"
                                    data-id="{{ $message->id }}">
                                    {{ $message->message }}
                                    <div
                                        class="w-full {{ $message->sender_id == auth()->id() ? 'text-left' : 'text-right' }}">
                                        <small class="text-[#ffffff80] text-[8pt]">
                                            {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="w-3/4 text-white fixed bottom-0 h-32 flex items-center justify-center">
                        <div class="w-2/3 h-full">
                            <form wire:submit="sendMessage" class="h-full flex items-end">
                                <div class="w-full mt-2">
                                    <textarea wire:keydown.enter.prevent="sendMessage" wire:keydown.shift.enter.prevent wire:model="messageText"
                                        rows="2"
                                        class="w-full bg-[#212121] p-3 rounded-md text-md resize-none custom-scrollbar-sidebar focus:outline-none"
                                        placeholder="Message"></textarea>
                                </div>
                                <button type="submit"
                                    class="size-12 ml-4 p-7 rounded-full bg-[#212121] flex items-center justify-center my-2 text-[#36ace9] hover:bg-[#36ace9] hover:text-white cursor-pointer">
                                    <i class="bx bxs-send text-2xl"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

@push('script')
    <script>
        Livewire.on('urlChange', (data) => {
            window.history.pushState({}, '', data[0].url);
        });
    </script>
    {{-- <script>
        console.log(window.Echo);
        var userId = {{ auth()->id() }};

        Echo.channel('chat.${userId')
            .listen('.message.sent', function(e) {
                console.log("پیام جدید دریافت شد", e);
                // Livewire.emit('messageReceived', e);
            });
    </script> --}}
@endpush
