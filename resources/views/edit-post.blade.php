@extends('index')
@section('content')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!--      <div class="text-center p-12 border border-gray-800 rounded-xl">-->
      <!--        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>-->
      <!--      </div>-->

      <!-- Barta Create Post Card -->
      <form
        action="{{url('edit-post/store/'.$data[0]->uuid)}}"    
        method="POST"
        enctype="multipart/form-data"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
        @csrf
       <!-- Create Post Card Top -->
       <div>
          <div class="flex items-start /space-x-3/">
            <!-- <User Avatar >
                       <div class="flex-shrink-0">
                         <img
                           class="h-10 w-10 rounded-full object-cover"
                           src="https://avatars.githubusercontent.com/u/831997"
                           alt="Ahmed Shamim" />
                       </div>
            </User Avatar > -->

            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
              <textarea
                class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                name="barta"
                rows="2"
                placeholder="What's going on, Shamim?">{{($data[0]->description)}}</textarea>
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