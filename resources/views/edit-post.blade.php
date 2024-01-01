@extends('index')
@section('content')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!--      <div class="text-center p-12 border border-gray-800 rounded-xl">-->
      <!--        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>-->
      <!--      </div>-->

      <!-- Barta Create Post Card -->
      <form
        action="{{url('edit-post/store/'.$data[0]->post_uuid)}}"    
        method="POST"
        enctype="multipart/form-data"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
        @csrf
       <!-- Create Post Card Top -->
       <div>
          <div class="flex items-start /space-x-3/">
            <!-- User Avatar -->
            <div class="flex-shrink-0">
                  @if ($logged_in_user_image)
                    <img  
                    class="h-10 w-10 rounded-full object-cover"
                    src="{{ asset('storage/profile_photo/' . $logged_in_user_image) }}"
                    alt="{{($data[0]->user->firstname)}}">
                    @else
                    <img 
                    class="h-10 w-10 rounded-full object-cover"
                    src="{{ asset('storage/profile_photo/' . 'placeholder.jpg') }}"
                    alt="{{($data[0]->user->firstname)}}">
                    @endif
              </div>
            <!-- /User Avatar -->
            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
             @if($data[0]->image) 
            <img
                class=" pt-14 pr-10"
                src="{{ asset('storage/post_photos/' . $data[0]->image) }}"
                class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72"
                alt="Post Image" />
              @endif  
              <textarea
                class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                name="barta"
                rows="2"
                placeholder="What's going on, {{($data[0]->user->firstname)}}?">{{($data[0]->description)}}</textarea>
                 <!-- Upload Picture Button -->
          <div>
                <input
                  type="file"
                  name="picture"
                  id="picture"
                  class="hidden" />

                <label
                  for="picture"
                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                  <span class="sr-only">Picture</span>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                  </svg>
                </label>
              </div>
              <!-- /Upload Picture Button -->
            </div>
          </div>
        </div>

        <!-- Create Post Card Bottom -->
        <div>
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-end">
                <div>
                    <!-- Cancel Button -->
                    <button class="-m-2 mr-4 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                        <a href="{{('/')}}"> 
                            Cancel
                        </a>
                    </button>
                    <!-- /Cancel Button -->
                </div>
                
                <!-- Post Button -->
                <button 
                    type="submit" 
                    class="-m-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                    Update
                </button>
                <!-- /Post Button -->
            </div>
            <!-- /Card Bottom Action Buttons -->
        </div>
        <!-- /Create Post Card Bottom -->
      </form>
      <!-- /Barta Create Post Card -->
    </main>
@endsection