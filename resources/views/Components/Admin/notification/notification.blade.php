{{-- resources/views/Components/Admin/notification/notification.blade.php --}}
<main class="flex-grow p-4 md:p-8 lg:p-12 bg-gray-100 font-sans"
      x-data="{
          localMessages: {{ Js::from($contactMessages) }},
          showModal: false,
          modalMessage: {},
          loading: false,

          openMessageModal(messageId) {
              this.loading = true;
              fetch(`/admin/notifications/${messageId}/show`)
                  .then(response => response.json())
                  .then(data => {
                      this.modalMessage = data.message;
                      this.showModal = true;

                      // Update read status locally
                      let msg = this.localMessages.find(m => m.id === messageId);
                      if (msg && !msg.is_read) {
                          msg.is_read = true;
                          window.dispatchEvent(new CustomEvent('notification-decrement'));
                      }
                  })
                  .catch(error => console.error('Error fetching message:', error))
                  .finally(() => this.loading = false);
          },

          markAsRead(messageId) {
              if (!confirm('Are you sure you want to mark this message as read?')) return;
              this.loading = true;
              fetch(`/admin/notifications/${messageId}/mark-read`, {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                  }
              })
              .then(response => response.json())
              .then(data => {
                  let msg = this.localMessages.find(m => m.id === messageId);
                  if (msg && !msg.is_read) {
                      msg.is_read = true;
                      window.dispatchEvent(new CustomEvent('notification-decrement'));
                  }
                  alert(data.message);
              })
              .catch(error => console.error('Error marking message as read:', error))
              .finally(() => this.loading = false);
          },

          deleteMessage(messageId) {
              if (!confirm('Are you sure you want to delete this message?')) return;
              this.loading = true;
              fetch(`/admin/notifications/${messageId}`, {
                  method: 'DELETE',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                  }
              })
              .then(response => response.json())
              .then(data => {
                  this.localMessages = this.localMessages.filter(m => m.id !== messageId);
                  window.dispatchEvent(new CustomEvent('notification-decrement'));
                  alert(data.message);
              })
              .catch(error => console.error('Error deleting message:', error))
              .finally(() => this.loading = false);
          }
      }">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 mt-4">Inbox Messages</h1>

        <div x-show="localMessages.length === 0" class="bg-white rounded-lg shadow-md p-6 text-center text-gray-600">
            <p class="text-lg">No new messages at the moment.</p>
            <p class="text-sm mt-2">Check back later for updates!</p>
        </div>

        <div x-show="localMessages.length > 0" class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700">Recent Contact Messages</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <template x-for="message in localMessages" :key="message.id">
                    <div class="flex flex-col md:flex-row items-start md:items-center px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        {{-- Status --}}
                        <div class="flex-shrink-0 mr-4">
                            <span class="h-3 w-3 rounded-full inline-block"
                                  :class="message.is_read ? 'bg-green-500' : 'bg-blue-500'"
                                  :title="message.is_read ? 'Read' : 'Unread'"></span>
                        </div>

                        {{-- Sender --}}
                        <div class="flex-grow">
                            <div class="text-sm text-gray-900 font-semibold truncate" x-text="`${message.user_name} (${message.user_email})`"></div>
                            <div class="text-base text-gray-700 font-medium mt-1" x-text="message.subject"></div>
                            <p class="text-gray-500 text-sm mt-1 line-clamp-2 md:hidden" x-text="message.message"></p>
                        </div>

                        {{-- Preview (desktop only) --}}
                        <div class="hidden md:block flex-1 mx-4 text-gray-600 text-sm line-clamp-2" x-text="message.message"></div>

                        {{-- Date + Buttons --}}
                        <div class="flex-shrink-0 ml-auto text-right mt-2 md:mt-0">
                            <div class="text-gray-500 text-xs whitespace-nowrap" x-text="new Date(message.created_at).toLocaleString()"></div>
                            <div class="mt-2 flex justify-end gap-2">
                                <button @click="openMessageModal(message.id)" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</button>
                                <button x-show="!message.is_read" @click="markAsRead(message.id)" class="text-blue-300 hover:text-green-800 text-sm font-medium">Mark Read</button>
                                <button @click="deleteMessage(message.id)" class="text-gray-500 hover:text-red-800 text-sm font-medium">Delete</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Loading --}}
        <div x-show="loading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg shadow-lg">Loading...</div>
        </div>

        {{-- Modal --}}
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.away="showModal = false">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-2xl w-full relative"
                 @click.stop
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Message Details</h3>
                <button @click="showModal = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="space-y-3 text-gray-700">
                    <p><strong>From:</strong> <span x-text="modalMessage.user_name"></span> (<span x-text="modalMessage.user_email"></span>)</p>
                    <p><strong>Subject:</strong> <span x-text="modalMessage.subject"></span></p>
                    <p><strong>Date:</strong> <span x-text="new Date(modalMessage.created_at).toLocaleString()"></span></p>
                    <p><strong>Status:</strong> <span :class="modalMessage.is_read ? 'text-green-600' : 'text-blue-600'" x-text="modalMessage.is_read ? 'Read' : 'Unread'"></span></p>
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <p class="font-semibold mb-1">Message:</p>
                        <p x-text="modalMessage.message"></p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button @click="showModal = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
