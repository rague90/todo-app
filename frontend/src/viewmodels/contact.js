import http from '../util/http'

class Contact {
    getAll() {
        return http.get('api/contacts')        
    }

    // getOne(id) {

    // }

    create(contactObject) {
        return http.post('api/contacts', contactObject)
    }

    // update(id, request) {

    // }

    delete(id) {
        return http.delete(`api/contacts/${id}`)
    }
}

export default new Contact