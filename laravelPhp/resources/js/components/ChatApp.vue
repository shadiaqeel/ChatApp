<template>
  <div class="ChatApp">
    <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" />
    <ContactsList :contacts="contacts" @selected="startConversationWith" />
  </div>
</template>



// =======  script ================================= >>>>>>>>>>>>>>>>>>>>>>>>>



<script>
import Conversation from "./Conversation";
import ContactsList from "./ContactsList";
import axios from "axios";
import { debug } from "util";

export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: [],
      DataLoaded: false
    };
  },
  mounted() {
    // =======  Send Request to  Server   =======

    // axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    axios
      .get("/contacts")
      .then(response => {
        //Vue.set(this,'contacts',response.data);
        this.contacts = response.data;
        //this.DataLoaded = true;
      })
      .catch(error => console.log(error));

    // =======  create Private channel  with Server  for handle New Message =======

    Echo.private(`messages.${this.user.id}`).listen("NewMessageEvent", e => {
      this.handleIncoming(e.message);
    });

    // =======  Debug =======

    //console.log("Chat App Component mounted.");
  },
  components: { Conversation, ContactsList },
  methods: {
    startConversationWith(contact) {
      this.UpdateUnreadCount(contact, true);
      axios.get(`/conversation/${contact.id}`).then(response => {
        this.messages = response.data;
        this.selectedContact = contact;
      });
    },
    saveNewMessage(text) {
      this.messages.push(text);
    },
    handleIncoming(message) {
      //console.log(" handleIncoming = " + this.selectedContact +" >>>>  "+ message.id +" === "+ this.selectedContact.id);
      if (this.selectedContact && message.from === this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }

      this.UpdateUnreadCount(message.from_contact, false);
      //alert(message.text);
    },
    UpdateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map(single => {
        if (single.id != contact.id) return single;

        if (reset) single.unread = 0;
        else single.unread += 1;

        return single;
      });
    }
  }
};
</script>



// =======  style ================================= >>>>>>>>>>>>>>>>>>>>>>>>>

<style lang="scss" scoped>
.ChatApp {
  display: flex;
  background-color : #f0f0f000;
  width:100%;
}
</style>


