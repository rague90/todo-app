<template>
  <div class="container">
    <div class="card">
      <div class="card bg-info text-white">
        <div class="card-body">Tudo List App</div>
      </div>

      <!-- <div class="alert alert-danger" v-if="errors.length">
        <ul>
          <li v-for="(error, index) in errors" :key="index">
            {{ error }}
          </li>
        </ul>
      </div> -->

      <div class="row">
        <form @submit.prevent="createContact">

        <div class="col">
            <label for="">Name:</label>
            <input
              type="name"
              class="form-control"
              placeholder="Enter your name"
              name="name"
              v-model="contact.name"
            />
          </div>

          <div class="col">
            <label for="">Email:</label>
            <input
              type="email"
              class="form-control"
              placeholder="Enter your Email"
              name="email"
              v-model="contact.email"
            />
          </div>

          <div class="col">
            <label for=""> Phone:</label>
            <input
              type="tel"
              class="form-control"
              placeholder="Format 000-00-00-00"
              v-model="contact.Tel"
            />
          </div>
          <div class="col">
            <label for="">function:</label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter your Fonction"
              v-model="contact.fonction"
            />
          </div>
          <button name="buttonadd" class="btn btn-info rounded-2 m-1">
            ADD User<span class="fa fa-user"></span>
          </button>
        </form>
    </div>

      <div class="row justify-content-center">
        <table class="thead-dark">
          <thead>
            <tr>
              <th class="cell" style="text-align: center">
                ID <span class="fa fa-user"></span>
              </th>
              <th class="cell" style="text-align: center">
                Name <span class="fa fa-user"></span>
              </th>
              <th class="cell" style="text-align: center">
                Adress Email<span class="fa fa-envelope"></span>
              </th>
              <th class="cell" style="text-align: center">
                Phone <span class="fa fa-mobile-alt"></span>
              </th>
              <th class="cell" style="text-align: center">
                Function <span class="fa fa-tools"></span>
              </th>
              <th colspan="2" class="cell" style="text-align: center">
                Action <span class="fa fa-pen-alt"></span>
              </th>
            </tr>
          </thead>
          <tbody v-for="contact in contacts" :key="contact.id">
            <tr>
                <td>{{ contact.id }}</td>
              <td style="text-align: center">{{ contact.name }}</td>
              <td style="text-align: center">{{ contact.email }}</td>
              <td style="text-align: center">{{ contact.Tel }}</td>
              <td style="text-align: center">{{ contact.fonction }}</td>
              <td>
                edit
                <!-- <button
                  type="button"
                  class="btn btn-outline-primary"
                  @click.prevent="getContactbyID(contact.id)"
                >
                  Edit
                </button> -->
              </td>
              <td>
                <button
                  class="btn btn-outline-danger"
                  @click="deleteContact(contact.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Contact from '../viewmodels/contact'
export default {
  name: "HomePage",
  data() {
    return {
      contacts: [],
      contact: {
        name: '',
        email: '',
        Tel: '',
        fonction: ''
      }
    };
  },
  //create
  methods: {
    createContact() {
        Contact.create(this.contact)
        .then(res => { this.contacts.push(res.data) })
        .catch(e => { console.error(e) })
    },
    deleteContact(id) {
        Contact.delete(id)
        .then(res => { 
            if (res.data.code == 200) {
                this.contacts = this.contacts.filter(c => c.id !== id)
            } else {
                console.log("cannot delete contact...")
            }
        })
        .catch(e => { console.error(e) })
    }
  },
  created() {
    Contact.getAll()
    .then(res => { this.contacts = res.data })
  }
};
</script>
<style scoped>
.container {
  margin-top: 20px;
}
.card-body {
  text-align: center;
}
.input {
  margin-left: 4px;
  margin-right: 4px;
}
.row {
  margin-top: 50px;
}
.row {
  margin: 10px;
}
button {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}

.btn-info {
  color: white;
  font-size: 25px;
}
</style>



async saveContact() {
    //     console.log({name: this.contact.name, email: this.contact.email, Tel: this.contact.tel, fonction: this.contact.fonction})
    //     let url = "http://localhost:8000/api/save_contact";
    //     await axios
    //       .post(url, {name: this.contact.name, email: this.contact.email, Tel: this.contact.Tel, fonction: this.contact.fonction}, {
    //         'Accept': 'application/json'
    //       })
    //       .then(res => { console.log(res) })
    // },
    // //update contact
    // async UpdateContact() {
    //   this.errors = [];
    //   if (!this.contact.name) {
    //     this.errors.push("Name is required");
    //   }
    //   if (!this.contact.email) {
    //     this.errors.push("Email is required");
    //   }
    //   if (!this.contact.Tel) {
    //     this.errors.push("Tel is required");
    //   }
    //   if (!this.contact.fonction) {
    //     this.errors.push("Fonction is required");
    //   }
    //   if (!this.errors.length) {
    //     let formData = new FormData();
    //     formData.append("name", this.contact.name);
    //     formData.append("email", this.contact.email);
    //     formData.append("Tel", this.contact.Tel);
    //     formData.append("fonction", this.contact.fonction);
    //     let url = `http://127.0.0.1:8000/api/update_contact/${this.contact.id}`;

    //     await axios
    //       .post(url, formData)
    //       .then((response) => {
    //         console.log(response);

    //         if (response.status == 200) {
    //           this.edit_todo = null;
    //           this.contact.name = "";
    //           this.contact.email = "";
    //           this.contact.Tel = "";
    //           this.contact.fonction = "";
    //           console.log.apply(this.edit_todo);
    //           alert(response.data.message);
    //           this.getContacts();
    //         } else {
    //           console.log("error");
    //         }
    //       })
    //       .catch((errors) => {
    //         this.error.push(errors.response);
    //       });
    //   }
    // },
    // // Delete Contact
    // async DeleteContact(id) {
    //   let url = `http://127.0.0.1:8000/api/delete_Contact/${id}`;
    //   await axios
    //     .delete(url)
    //     .then((response) => {
    //       if (response.data.code == 200) {
    //         alert(response.data.message);
    //         this.getContacts();
    //       }
    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },

    // //get  Contact ID
    // async getContactbyID(id) {
    //   let url = `http://127.0.0.1:8000/api/getcontact/${id}`;
    //   await axios.get(url).then((response) => {
    //     console.log(response);
    //     this.contact = response.data;
    //     this.edit_todo = this.contact.id;
    //     console.log(this.edit_todo);
    //   });
    // },