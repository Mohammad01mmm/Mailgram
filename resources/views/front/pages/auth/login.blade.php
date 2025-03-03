@push('style')
    <style>
        @keyframes fly-rotate {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            5% {
                transform: translateX(10px) rotateX(10deg);
            }

            10% {
                transform: translateX(200px) rotateX(50deg);
            }

            20% {
                transform: translateX(300px) translateY(-10px) rotateX(90deg) rotateZ(-150deg);

            }

            30% {
                transform: translateX(-300px) rotateX(100deg) rotateZ(0deg);
            }

            40% {
                transform: translateX(0px) translateY(10px) rotateX(100deg) rotateZ(0deg);
            }

        }

        .animate-telegram {
            animation: fly-rotate 5s ease-in-out infinite;
        }
    </style>
@endpush
<div class="w-1/4 h-full mx-auto py-36">
    <div class="text-center">
        <i class='bx bxl-telegram text-9xl text-[#36ace9] animate-telegram'></i>
        <h1 class="text-3xl text-white my-1 mt-3"> MailGram </h1>
        <small class="text-white"> Please Enter Your Email And Password to Login to MailGram ;) </small>
    </div>
    <form wire:submit.prevent="login" autocomplete="off">
        @if (session()->has('error'))
            <div class="w-full my-1 p-3 borde rounded bg-red-500 text-white font-bold">{{ session('error') }}</div>
        @endif
        <div class="mb-3 mt-2">
            <div class="relative w-full">
                <input id="email" type="text" wire:model.defer="email"
                    class="peer w-full border border-gray-500 text-lg font-semibold rounded-xl p-4 px-5
               focus:outline-none focus:ring-1 focus:ring-[#36ace9] focus:border-[#36ace9]
               bg-transparent text-white placeholder-transparent"
                    placeholder="Your email">
                <label for="email"
                    class="absolute left-4 text-gray-400 text-sm transition-all
               peer-placeholder-shown:bottom-6 peer-placeholder-shown:scale-150 peer-placeholder-shown:left-11
               peer-focus:bottom-[53px] peer-focus:scale-100 peer-focus:left-4  peer-focus:px-2 peer-focus:bg-[#212121]  peer-focus:text-[#36ace9]">
                    Your email
                </label>

            </div>
            @error('email')
                <div class="text-red-500 my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 mt-2">
            <div class="relative w-full">
                <input id="password" type="password" wire:model.defer="password"
                    class="peer w-full border border-gray-500 text-lg font-semibold rounded-xl p-4 px-5
               focus:outline-none focus:ring-1 focus:ring-[#36ace9] focus:border-[#36ace9]
               bg-transparent text-white placeholder-transparent"
                    placeholder="Your Password">
                <label for="password"
                    class="absolute left-4 text-gray-400 text-sm transition-all
               peer-placeholder-shown:bottom-6 peer-placeholder-shown:scale-150 peer-placeholder-shown:left-11
               peer-focus:bottom-[53px] peer-focus:scale-100 peer-focus:left-4  peer-focus:px-2 peer-focus:bg-[#212121]  peer-focus:text-[#36ace9]">
                    Your Password
                </label>
            </div>
            @error('password')
                <div class="text-red-500 my-2">{{ $message }}</div>
            @enderror
        </div>

        <input class="w-full rounded-xl py-3 text-white font-bold bg-[#36ace9] cursor-pointer" type="submit"
            value="NEXT">
    </form>
</div>
