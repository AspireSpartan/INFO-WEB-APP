<x-layout>
    <body>
    <!-- HERO SECTION: Background image, gradients, and intro -->
    <div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
      <!-- Background Image -->
      <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply" alt="" class="absolute inset-0 -z-10 size-full object-cover object-right md:object-center">
      <!-- Top Gradient Shape -->
      <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl" aria-hidden="true">
        <div class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <!-- Bottom Gradient Shape -->
      <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu" aria-hidden="true">
        <div class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <!-- MAIN HERO CONTENT -->
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <h2 class="text-5xl font-semibold tracking-tight text-white sm:text-7xl">Welcome to the Official LGU Portal</h2>
          <p class="mt-8 text-lg font-medium text-pretty text-gray-300 sm:text-xl/8">
            The Local Government Unit (LGU) of the Philippines is committed to providing transparent governance, quality public service, and community-driven development. Stay informed about local initiatives, public advisories, and opportunities to participate in building a better community.
          </p>
        </div>
        <!-- QUICK LINKS SECTION -->
        <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
          <div class="grid grid-cols-1 gap-x-8 gap-y-6 text-base/7 font-semibold text-white sm:grid-cols-2 md:flex lg:gap-x-10">
            <a href="#">Citizen Services <span aria-hidden="true">&rarr;</span></a>
            <a href="#">Barangay Programs <span aria-hidden="true">&rarr;</span></a>
            <a href="#">Transparency & Governance <span aria-hidden="true">&rarr;</span></a>
            <a href="#">Meet Your Officials <span aria-hidden="true">&rarr;</span></a>
          </div>
          <!-- STATISTICS SECTION -->
          <dl class="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-gray-300">Barangays</dt>
              <dd class="text-4xl font-semibold tracking-tight text-white">24</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-gray-300">Population Served</dt>
              <dd class="text-4xl font-semibold tracking-tight text-white">150,000+</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-gray-300">Public Projects</dt>
              <dd class="text-4xl font-semibold tracking-tight text-white">120+</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-gray-300">Years of Service</dt>
              <dd class="text-4xl font-semibold tracking-tight text-white">75</dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- BLOG/NEWSFEED SECTION -->
      <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0 text-center lg:text-left">
            <h2 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl mb-2">LGU News & Announcements</h2>
            <p class="text-lg text-gray-600">Get the latest updates on local ordinances, community events, and government advisories from your LGU.</p>
          </div>
          <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <!-- Newsfeed Cards (Dynamic) -->
            @if($newsfeeds->count())
                @foreach ($newsfeeds as $newsfeed)
                <article x-data="{ editMode: false }" class="flex flex-col items-start rounded-2xl bg-white shadow-none" id="newsfeed-{{ $newsfeed->id }}">
                    <!-- Newsfeed Card View Mode -->
                    <template x-if="!editMode">
                        <div>
                            <img src="{{ asset('storage/' . $newsfeed->image_path) }}" alt="" class="mb-6 w-full h-64 object-cover rounded-xl">
                            <div class="flex items-center gap-x-4 text-xs mb-2">
                                <time datetime="{{ $newsfeed->published_at }}" class="text-gray-500">{{ $newsfeed->published_at }}</time>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $newsfeed->title }}</h3>
                            <p class="text-gray-600 mb-6">{{ $newsfeed->content }}</p>
                            <div class="flex items-center gap-x-4 mt-auto">
                                <img src="{{ asset('storage/' . $newsfeed->icon_path) }}" alt="" class="w-10 h-10 rounded-full bg-gray-50">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $newsfeed->author }}</p>
                                    <p class="text-gray-600 text-sm">{{ $newsfeed->authortitle }}</p>
                                </div>
                            </div>
                            <button @click="editMode = true"
                                class="mt-4 inline-block rounded bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500 transition">
                                Edit
                            </button>
                        </div>
                    </template>
                    <!-- Newsfeed Card Edit Mode -->
                    <template x-if="editMode">
                        <form action="{{ route('newsfeeds.update', $newsfeed->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                            @csrf
                            @method('PUT')
                            <!-- Preview image -->
                            <img src="{{ asset('storage/' . $newsfeed->image_path) }}" alt="" class="mb-6 w-full h-64 object-cover rounded-xl">
                            <div class="flex items-center gap-x-4 text-xs mb-2">
                                <input type="date" name="published_at" value="{{ old('published_at', $newsfeed->published_at ? \Illuminate\Support\Carbon::parse($newsfeed->published_at)->format('Y-m-d') : '') }}" required class="text-gray-500 border rounded px-2 py-1">
                            </div>
                            <input type="text" name="title" value="{{ old('title', $newsfeed->title) }}" required class="mb-2 w-full border rounded px-2 py-1 text-xl font-semibold text-gray-900" placeholder="Title">
                            <textarea name="content" required class="mb-2 w-full border rounded px-2 py-1 text-gray-600" placeholder="Content">{{ old('content', $newsfeed->content) }}</textarea>
                            <div class="flex items-center gap-x-4 mt-auto mb-4">
                                <img src="{{ asset('storage/' . $newsfeed->icon_path) }}" alt="" class="w-10 h-10 rounded-full bg-gray-50">
                                <div>
                                    <input type="text" name="author" value="{{ old('author', $newsfeed->author) }}" required class="font-semibold text-gray-900 border rounded px-2 py-1 mb-1" placeholder="Author">
                                    <input type="text" name="authortitle" value="{{ old('authortitle', $newsfeed->authortitle) }}" required class="text-gray-600 text-sm border rounded px-2 py-1" placeholder="Author Title">
                                </div>
                            </div>
                            <label class="block mb-2 text-sm font-medium text-gray-700" for="image_upload_{{ $newsfeed->id }}">Change Image</label>
                            <input type="file" name="image_upload" id="image_upload_{{ $newsfeed->id }}" class="mb-2 w-full border rounded px-2 py-1">
                            <label class="block mb-2 text-sm font-medium text-gray-700" for="icon_upload_{{ $newsfeed->id }}">Change Icon</label>
                            <input type="file" name="icon_upload" id="icon_upload_{{ $newsfeed->id }}" class="mb-2 w-full border rounded px-2 py-1">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
                                <button type="button" @click="editMode = false" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                            </div>
                        </form>
                    </template>
                </article>
                @endforeach
            @endif
          </div>
        </div>
      </div>

      {{-- 
        TEAM SECTION: Static team members, not dynamic
      --}}
      <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Meet Your LGU Team</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">
              Our dedicated LGU officials and staff are committed to serving the people of our municipality. Together, we strive for progress, transparency, and inclusive growth for every Filipino family.
            </p>
          </div>
          <ul role="list" class="mx-auto mt-20 grid max-w-4xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Team Member 1 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/495261489_2871703749669777_6522045126610493016_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH_g-w0RLHevJk6nfqaTj4pEnxHZJBTAqYSfEdkkFMCppz2lmIJQ3s0EMvtQhooCb6O1IQT2q_rZbXHGSIHM9Wm&_nc_ohc=NFu2vwgFPDcQ7kNvwHRFEjQ&_nc_oc=AdmOrviEPCDPSsRtjQ5NB-zh6E6CLHKr_MBtBaR_9Ay0N0BtFK5UenG3Rh9yomxoBQA&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=5d6tl63VW7VJ55wETsu5Cg&oh=00_AfOIyd3h88CVkmyXqiOtb1lvvGMY9y1o5nXEq-Ww0Vqk-Q&oe=68472B40" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Janpaul Bustillo</h3>
                <p class="text-gray-600">Municipal Administrator</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
            <!-- Team Member 2 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/439979555_8425004204192885_23963868889279716_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH0U-Pj3hxQAzBvEnJgxIruFNYu4MGlHV4U1i7gwaUdXvUeN7T4iLdxMiU0_Zh9qgjKDCgCiQmkRE8jFOZ0t4oj&_nc_ohc=v27J0bsB-uUQ7kNvwFo1Am2&_nc_oc=AdlK77MB2TJUtnLVPRfMHQY2yH2Q9iBeObcXQeqSvmvXnjmZWqYcSu3idPuad0CgVbs&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=nQPDVOqq6q_Ac-767_ZV4A&oh=00_AfMqpYbhDNI3YHVb2DI-Lc2BbzqK_oYnAPpfEkP95wseag&oe=68473B0E" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Kerstan Zam Davide</h3>
                <p class="text-gray-600">Public Information Officer</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
            <!-- Team Member 3 -->
            <li class="flex flex-col items-center">
              <img class="w-full h-56 object-cover rounded-2xl" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/432407394_1645695422631958_4371129882617179964_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGZfkfQnY1M1Fgs01fgbasTG1J3clYceBIbUndyVhx4EgqI4qUwzsmAjH33ssUXAUgc6a4UOxAyME4pYGoPhRit&_nc_ohc=3ZIJimNdEPsQ7kNvwFvuAYK&_nc_oc=Adm24XhLhdi6XdXje7oDX80AKlfefXNalvEwAeH1FDkp-_IefMKELRBYB5OSiQ5OUdU&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=DENrHTPYSJU_ZM8gCie36A&oh=00_AfNa1sibCwsI6taPkRlHv998Yy6XEUR8wdIujLaIS537Mg&oe=68472D4A" alt="">
              <div class="mt-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Jaspher Lawrence Siloy</h3>
                <p class="text-gray-600">LGU Web Administrator</p>
                <div class="mt-4 flex justify-center gap-x-4">
                  <!-- Social Links -->
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                  </a>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-2-7h2v6H8v-6zm1-1a1 1 0 110-2 1 1 0 010 2zm4 1h2v3.5a1.5 1.5 0 01-3 0V10h1v1.5a.5.5 0 001 0V10z"/></svg>
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>

    </div>
    </body>
</x-layout>