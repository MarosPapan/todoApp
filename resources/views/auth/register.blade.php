@extends("layouts.auth")

@section("style")
<!--
  style specific for this page, e.g.:
-->
@endsection

@section("content")
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
              </h1>
              <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register.post') }}">
                @csrf
                <div> 
                    @error('name')
                    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert">
                    <span class="font-medium">{{ $message }}</span> Change a few things up and try submitting again.
                    </div>
                    @enderror
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label> 
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" required=""> 
                    
                </div>  
                  <div>
                    @error('email')
                    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert">
                    <span class="font-medium">{{ $message }}</span> Change a few things up and try submitting again.
                    </div>
                    @enderror
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                  </div>
                  <div>
                    @error('password')
                    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert">
                    <span class="font-medium">{{ $message }}</span> Change a few things up and try submitting again.
                    </div>
                    @enderror
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                    @error('password_confirmation')
                    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert">
                    <span class="font-medium">{{ $message }}</span> Change a few things up and try submitting again.
                    </div>
                    @enderror
                      <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div class="flex items-start">
                      <!-- <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                      </div> -->
                      <!-- <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                      </div> -->
                  </div>

                @if(session()->has("success"))
                <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm" role="alert">
                    <span class="font-medium">{{ session()->get("success") }}</span> 
                </div> 
                @endif

                @if(session()->has("error")) 
                <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert"> 
                    <span class="font-medium">{{ session()->get("error") }}</span> 
                </div>
                @endif

                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                  </p>
              </form>
          </div>
      </div>

@endsection