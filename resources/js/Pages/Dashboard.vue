<template>
    <app-layout title="Dashboard">
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <!-- component -->

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" >
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 antialiased text-gray-800">
                        <div class="md:col-span-0 lg:col-span-2 flex flex-row w-full flex-shrink-0 p-4">
                            <div class="flex flex-col w-full py-4 relative">
                                <div class="flex flex-row items-center">
                                    <div class="flex flex-row items-center">
                                        <div class="text-xl font-semibold">Messages</div>
                                        <div class="flex items-center justify-center ml-2 text-xs h-5 w-5 text-white bg-red-500 rounded-full font-medium">
                                            5
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <button
                                            class="flex items-center justify-center h-7 w-7 bg-gray-200 text-gray-500 rounded-full">
                                            <svg class="w-4 h-4 stroke-current"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <ul class="flex flex-row items-center justify-between">
                                        <li>
                                            <a href="#"
                                               class="flex items-center pb-3 text-xs font-semibold relative text-indigo-800">
                                                <span>All Conversations</span>
                                                <span
                                                    class="absolute left-0 bottom-0 h-1 w-6 bg-indigo-800 rounded-full"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="flex items-center pb-3 text-xs text-gray-700 font-semibold">
                                                <span>Archived</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="flex items-center pb-3 text-xs text-gray-700 font-semibold">
                                                <span>Starred</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="messages flex flex-col space-y-4 overflow-x-hidden overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                                    <div class="pt-2">
                                        <div class="flex flex-col">
                                            <user-item
                                                v-for="(userItem, idx) in users"
                                                :key="userItem.id"
                                                @click.prevent="selectUser(idx, userItem.id)"
                                                :user-item="userItem"
                                                :typing-users="typingUserIds"
                                                :classes="userItem.id === userId? 'bg-gradient-to-r from-indigo-200 to-transparent border-l-4 border-indigo-500':''"
                                                :is_online="liveUsers.findIndex(x=>x.id=== userItem.id) > -1"
                                            >

                                            </user-item>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 right-0 mr-2">
                                    <button
                                        class="flex items-center justify-center shadow-sm h-10 w-10 bg-red-500 text-white rounded-full">
                                        <svg class="w-6 h-6"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2 lg:col-span-4 flex flex-col h-full w-full bg-gray-50 pt-6" >
                            <div v-if="selectedUser" class="flex flex-row items-center py-4 px-6 rounded-2xl shadow bg-white mb-5 mx-4">
                                <div class="flex items-center justify-center">
                                    <img :src="selectedUser.profile_photo_url" :alt="selectedUser.name" class=" h-10 w-10 rounded-full">
                                </div>
                                <div class="flex flex-col ml-3">
                                    <div class="font-semibold text-sm">{{ selectedUser.name }}</div>
                                    <div class="text-xs text-gray-500">Active</div>
                                </div>
                                <div class="ml-auto">
                                    <ul class="flex flex-row items-center space-x-2">
                                        <li>
                                            <a href="#"
                                               class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-400 h-10 w-10 rounded-full">
                                                <span>
                                                    <svg class="w-5 h-5"
                                                       fill="currentColor"
                                                       stroke="none"
                                                       viewBox="0 0 24 24"
                                                       xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-400 h-10 w-10 rounded-full">
                                                <span>
                                                    <svg class="w-5 h-5"
                                                       fill="currentColor"
                                                       stroke="none"
                                                       viewBox="0 0 24 24"
                                                       xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-400 h-10 w-10 rounded-full">
                                                <span>
                                                    <svg class="w-5 h-5"
                                                       fill="none"
                                                       stroke="currentColor"
                                                       viewBox="0 0 24 24"
                                                       xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="messageList" class="messages bg-gray-50  space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                                <div class="grid grid-cols-12 gap-y-2 " >
                                    <div v-if="messages && messages.length > 0"
                                         v-for="(message, mIdx) in messages"
                                         :key="mIdx"
                                         :class="message.sender_id == userId? 'col-start-1 col-end-8': 'col-start-6 col-end-13'"
                                         class=" p-3 rounded-lg">
                                        <div class="flex items-center"
                                             :class="message.sender_id == userId? 'flex-row': 'justify-start flex-row-reverse'"
                                        >
                                            <div class="flex items-center justify-center flex-shrink-0">
                                                <img v-if="message.sender_id == userId" :src="selectedUser.profile_photo_url" :alt="selectedUser.name" class=" h-10 w-10 rounded-full">
                                                <img v-else :src="authUser.profile_photo_url" :alt="authUser.name" class=" h-10 w-10 rounded-full">
                                            </div>

                                            <div class="relative text-sm  py-2 px-4 shadow rounded-xl"
                                                 :class="message.sender_id == userId? 'bg-white ml-3': 'mr-3 text-white bg-indigo-400'"
                                            >
                                                <div v-if="message.message_type == types['Text']">{{ message.message }}</div>
                                                <a :href="message.message" target="_blank" class="w-32 rounded" v-if="message.message_type == types['Image']">
                                                    <img :src="message.message"
                                                         alt="image" class="w-32 max-h-32 rounded shadow">
                                                </a>
                                                <small class="float-right">{{ message.send_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg" v-if="typingUserIds.indexOf(selectedUser.id) > -1">
                                        <div class="flex items-center flex-row">
                                            <div class="flex items-center justify-center flex-shrink-0">
                                                <img :src="selectedUser.profile_photo_url" :alt="selectedUser.name" class=" h-10 w-10 rounded-full">
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>
                                                    <div class="circle bg-indigo-500" id="circle1"></div>
                                                    <div class="circle bg-indigo-400" id="circle2"></div>
                                                    <div class="circle bg-indigo-300" id="circle3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" @submit.prevent="sendMessage()" class="inline">
                                <div v-if="temp_images.length > 0" class="bg-gray-100 px-5 py-2 space-y-2 lg:space-y-0 lg:gap-2 flex items-start content-start">
                                    <div class="w-32 rounded relative" v-for="(image, idx) of temp_images">
                                        <a class="h-6 w-6 bg-red-600 rounded-full absolute top-0 right-0 flex justify-center items-center"
                                            href="#" @click.prevent="removeImage(idx)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                        <img :src="image"
                                             alt="image" class="w-32 max-h-32 rounded shadow">
                                    </div>
                                </div>
                                <div class="flex flex-row items-center bg-white px-6 pb-4 pt-2">

                                    <div class="flex flex-row items-center w-full border rounded-3xl h-12 px-2">
                                        <button type="button" class="flex items-center justify-center h-10 w-10 text-gray-400 ml-1 relative"
                                            @click.prevent="startRecording"
                                        >
                                            <svg class="w-5 h-5"
                                                 :class="is_recording?'text-purple-700': ''"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                            </svg>
                                            <span v-if="is_recording" class="animate-ping absolute inline-flex w-6 h-6 rounded-full bg-purple-400 opacity-75"></span>
                                        </button>
                                        <div class="w-full" v-if="is_recording || stop_recording">
                                            <p class="text-purple-500 font-bold pl-3" v-if="!stop_recording">Recording.....</p>
                                            <audio v-if="stop_recording" :src="temp_audio_url" controls class="w-full" style="padding: 10px;"></audio>
                                        </div>
                                        <div class="w-full" v-else>
                                            <input type="text"
                                                   v-model="form.text_message"
                                                   @keyup="typing()"
                                                   :disabled="temp_images.length > 0"
                                                   class="border border-transparent w-full focus:outline-none text-sm h-10 flex items-center"
                                                   placeholder="Type your message....">

                                        </div>
                                        <div class="flex flex-row">
                                            <template v-if="is_recording || stop_recording">
                                                <button class="flex items-center justify-center h-10 w-8 text-gray-400" type="button"
                                                        v-if="is_recording"
                                                @click.prevent="stopAudioRecordAndProcess">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <button class="flex items-center justify-center h-10 w-8 text-gray-400" type="button"
                                                        v-if="stop_recording"
                                                        @click.prevent="clearRecord">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button class="flex items-center justify-center h-10 w-8 text-gray-400">
                                                    <svg class="w-5 h-5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                    </svg>
                                                </button>
                                                <button
                                                    @click.prevent="selectNewPhoto"
                                                    class="flex items-center justify-center h-10 w-8 text-gray-400 ml-1 mr-2">
                                                    <svg class="w-5 h-5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="ml-6">
                                        <button
                                            type="submit"
                                            class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white">
                                            <svg class="w-5 h-5 transform rotate-90 -mr-px"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="file" name="images"
               ref="ImagePath"
               @input="form.file_data = $event.target.files"
               class="opacity-0" id="images"
               accept="image/jpeg,image/jpg,image/png"
               @change="updatePhotoPreview"
               multiple
        >

<!--        @input="form.images = $event.target.files[0]"-->
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import UserItem from "@/Components/UserItem";
import _ from 'lodash';
import Recorder from 'recorder-js';

export default {
    components: {
        UserItem,
        AppLayout,
    },
    props:['users', 'user', 'types'],
    data(){
        return{
            page: 1,
            last_page:1,
            perPage: 15,
            userId:'',
            selectedUser: '',
            authUser: this.user,
            liveUsers:[],
            typingUserIds: [],
            messages: [],
            form: {
                user_id: '',
                text_message: '',
                message_type: this.types['Text'],
                file_data: []
            },

            temp_images: [],
            is_recording: false,
            stop_recording: false,
            audioContext: new (window.AudioContext || window.webkitAudioContext)(),
            recorder: '',
            gumStream: '',
            temp_blob_audio: '',
            temp_audio_url: '',

        }
    },
    created() {
        Echo.join(`live-users`)
            .here((users) => {
                this.liveUsers = users;
            })
            .joining((user) => {
                this.liveUsers.push(user);
            })
            .leaving((user) => {
                let idx = this.liveUsers.findIndex(x=>x.id === user.id);
                this.liveUsers.splice(idx, 1);
            });
    },
    mounted() {
        if (this.users){
            this.selectUser(0, this.users[0].id);
        }
        Echo.private(`chat.${this.authUser.id}`)
            .listen('NewMessageSendEvent', (e) => {
                if(e.message.sender_id == this.userId){
                    this.messages.push(e.message);
                    this.scrollToBottom();
                }
                this.updateLastMessage(e.message);
            });
        Echo.private(`typingevent`)
            .listenForWhisper('typing', (e) => {
                if (this.typingUserIds.indexOf(e.senderId) == -1 && e.receiverId === this.authUser.id){
                    this.typingUserIds.push(e.senderId);
                    setTimeout(()=>{
                        let idx = this.typingUserIds.indexOf(e.senderId);
                        this.typingUserIds.splice(idx, 1);
                    },3000)
                    this.scrollToBottom();
                }
            });
    },
    methods:{
        selectUser(idx, userId){
            if(this.userId !== userId){
                this.page = 1;
                this.selectedUser = this.users[idx];
                this.userId = userId;
            }

            let query = `?page=${this.page}&per_page=${this.perPage}`;
            axios.get(route('user.messages', userId)+query)
                .then((response) => {
                    if (response.status == 200){
                        if(this.page === 1){
                            this.messages = [...response.data.data.messages.data].reverse();
                            this.last_page = response.data.data.messages.last_page;
                        }else{
                            this.messages.push([...response.data.data.messages.data].reverse());
                        }
                        this.selectedUser.total_unread = 0;
                        this.scrollToBottom();
                    }
                }).catch(err => {
                    console.log(err)
                });
        },

        typing(){
            Echo.private(`typingevent`)
                .whisper('typing', {
                    "senderId": this.authUser.id,
                    'receiverId': this.userId
                });
        },
        scrollToBottom(){
            setTimeout(()=>{
                var objDiv = document.getElementById("messageList");
                document.getElementById("messageList").scrollTop = +objDiv.scrollHeight;
            }, 1000);

        },
        updateLastMessage(message){
            this.users.forEach((item) =>{
                if(item.id === message.sender_id || item.id === message.receiver_id){
                    item.last_message = message;
                    if(item.id !== this.selectedUser.id){
                        item.total_unread += 1;
                    }
                }
            })
        },
        sendMessage(){
            var formData = this.formData();
            axios.post(route('user.message.send'),formData)
                .then((response) => {
                    if (response.status === 200){
                        this.messages.push(response.data);
                        this.scrollToBottom();
                        this.updateLastMessage(response.data);
                        this.resetFormData();
                    }
                }).catch(err => {
                console.log(err)
            });
        },

        formData(){
            var fd = new FormData();
            fd.append('user_id', this.userId);
            fd.append('text_message', this.form.text_message);
            fd.append('message_type', this.form.message_type);

            if(this.form.message_type === this.types['Text']){
                fd.append('file_data', null);
            }else if(this.form.message_type === this.types['Audio']){
                let filename = new Date().toISOString();
                fd.append('file_data', this.temp_blob_audio, filename);
            }else if(this.form.message_type === this.types['Image']){
                let images = [];
                for (let i=0; i<this.temp_images.length; i++){
                    images.push(this.temp_images[i]);
                }
                fd.append('file_data', images);
            }

            return fd;
        },
        resetFormData(){
            this.form.user_id= '';
            this.form.text_message= '';
            this.form.message_type= this.types['Text'];
            this.form.file_data= null;
            this.temp_images = [];
            this.clearRecord();
        },
        selectNewPhoto() {
            this.$refs.ImagePath.click();
        },

        updatePhotoPreview() {
            this.form.message_type= this.types['Image'];

            for (let i=0; i< this.$refs.ImagePath.files.length; i++){
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.temp_images.push(e.target.result);
                };
                reader.readAsDataURL(this.$refs.ImagePath.files[i]);
            }

        },
        removeImage(key){
            this.temp_images.splice(key, 1);
            this.form.file_data.splice(key, 1);
            if(this.temp_images.length == 0){
                this.form.message_type= this.types['Text'];
            }
        },

        startRecording(){
            this.typing();
            const $that = this;
            navigator.mediaDevices.getUserMedia({audio: true})
                .then(function(stream) {
                    /* Create the Recorder object and configure to record mono sound (1 channel) Recording 2 channels will double the file size */
                    $that.recorder = new Recorder($that.audioContext, {
                        numChannels: 1,
                    });
                    $that.recorder.init(stream);
                    //start the recording process
                    $that.recorder.start()
                    .then(()=>{
                        $that.is_recording = true;
                    });
                    console.log("Recording started");
                })
                .catch(function(err) {
                    //enable the record button if getUserMedia() fails
                    console.log(err);
                    $that.is_recording = false;
                });

        },

        stopAudioRecordAndProcess(){
            const $that = this;
            this.recorder.stop()
                .then(({blob, buffer}) => {
                    $that.createDownloadLink(blob);
                });
        },
        createDownloadLink(blob) {
            this.temp_blob_audio = blob;
            let URL = window.URL || window.webkitURL;
            this.temp_audio_url = URL.createObjectURL(blob);
            this.stop_recording = true;
            this.is_recording = false;
        },
        clearRecord(){
            this.temp_blob_audio = '';
            this.recorder = '';
            this.gumStream = '';
            this.temp_audio_url = '';
            this.stop_recording = false;
            this.is_recording = false;
            this.form.message_type= this.types['Text'];
        },

    },
    computed: {
        allUsers(){
            return JSON.parse(JSON.stringify(this.users))
        }
    },
    watch:{
        allUsers:{
            handler(newVal, oldVal){
                if (newVal !== oldVal){
                    this.users.sort( ( a, b) => {
                        if(a.last_message && b.last_message){
                            return new Date(b.last_message.created_at) - new Date(a.last_message.created_at);
                        }
                        return false;
                    });
                }
            }
        }
    }
}
</script>

<style>

.messages {
    max-height: 62vh;
    min-height: 62vh;
    scroll-behavior: smooth;
}
/*#messageList{*/
/*    scroll-behavior: smooth;*/
/*}*/
.scrollbar-w-2::-webkit-scrollbar {
    width: 0.25rem;
    height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
    --bg-opacity: 1;
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
    --bg-opacity: 1;
    background-color: #edf2f7;
    background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
    border-radius: 0.25rem;
}


.circle {
    height: 15px;
    width: 15px;
    margin: 0 5px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    top: 0;
    -webkit-animation-duration: 2s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    animation-duration: 2s;
    animation-iteration-count: infinite;
    animation-timing-function: linear

}

#circle1 {
    -webkit-animation-name: circle1;
}

#circle2 {
    -webkit-animation-name: circle2;
}

#circle3 {
    -webkit-animation-name: circle3;
}

#circle1 {
    animation-name: circle1;
}

#circle2 {
    animation-name: circle2;
}

#circle3 {
    animation-name: circle3;
}

.cc1 {
    background-color: #9E9DA2
}


@-webkit-keyframes circle1 {
    0% {
        top: 5px;
    }
    15% {
        top: 10px;
    }
    25% {
        top: 0px;
    }
}

@-webkit-keyframes circle2 {
    10% {
        top: 5px;
    }
    25% {
        top: 10px;
    }
    35% {
        top: 0px;
    }
}

@-webkit-keyframes circle3 {
    15% {
        top: 5px;
    }
    30% {
        top: 10px;
    }
    40% {
        top: 0px;
    }
}

@keyframes circle1 {
    0% {
        top: 5px;
    }
    15% {
        top: 10px;
    }
    25% {
        top: 0;
    }
}

@keyframes circle2 {
    10% {
        top: 5px
    }
    25% {
        top: 10px;
    }
    35% {
        top: 0;
    }
}

@keyframes circle3 {
    15% {
        top: 5px;
    }
    30% {
        top: 10px;
    }
    40% {
        top: 0;
    }
}
</style>
