<?php
require_once __DIR__.'/bootstrap.php';
?>

<?php include 'views/header.php'; ?>
    <div id="app" v-cloak>
        <div v-show="viewModal" class="app-modal">            
            <div class="app-modal__overlay" @click="viewModal = false;"></div>
            <div class="app-modal-body" :style="{ background: isFormValid ? '#FCFF4B' : '#FEF9EF' }">
                <div class="m-3">
                    <form>                        
                        <div class="form-group mb-3">
                            <label class="text-dark display-6">Title: </label>
                            <input class="form-control" type="text" name="title" required v-model="form.title" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-dark display-6">Message</label>
                            <textarea class="form-control" name="message" id="content" cols="30" rows="10" required v-model="form.message"></textarea>
                        </div>
                        <br>                        
                        <button 
                            class="btn btn-secondary text-light"
                            @click.prevent="storeDoc" 
                        >Store</button>
                    </form>
                </div>
            </div>            
        </div>
        <div class="container p-2">            
            <div>
                <button type="button" class="btn btn-sm btn-primary" @click.prevent="viewModal = true;">Add</button>
                <button 
                    type="button" class="btn btn-sm" @click.prevent="fetchDocs"
                >🔄</button>
                <div class="btn-group" role="group" aria-label="Commands">
                    <button 
                        v-show="docs.length > 0"
                        type="button" class="btn btn-sm btn-secondary" @click="showAllDocs"
                    >Show all</button>
                    <button 
                        v-show="docs.length > 0"
                        type="button" class="btn btn-sm btn-secondary" @click="hideAllDocs"
                    >Hide all</button>
                </div>
            </div>
            <table class="table">  
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                </tr>
                
                <tr v-for="doc in docs" :key="doc.id">
                    <td>
                        <div class="d-flex">
                            <div class="btn-group">
                                <button 
                                    class="btn btn-sm btn-outline-primary"
                                    @click="doc.isVisible = !doc.isVisible"
                                >{{ doc.isVisible ? 'Hide' : 'Show' }}</button>
                                <button 
                                    class="btn btn-sm btn-outline-danger"
                                    @click="deleteDoc(doc.id)"
                                >Delete</button>
                            </div>
                            <div class="mx-2">
                                <span>{{ doc.title }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <transition name="slide-fade">
                            <textarea v-show="doc.isVisible" class="form-control" cols="30" rows="5" :value="doc.message" readonly></textarea>
                        </transition>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        const { createApp, ref, computed } = Vue

        const app = createApp({
            setup() {
                const docs = ref([]);
                const form = ref({title: '', message: ''});
                let viewModal = ref(false);

                async function fetchDocs() {
                    resp = await axios.get(siteURL + 'api/list.php');
                    console.log(docs.value);
                    if (docs.value) {
                        docs.value = resp.data.response;
                    }
                }

                async function deleteDoc(identifier) {
                    var ok = confirm('Are you sure ?');
                    if (ok) {
                        resp = await axios.post(siteURL + 'api/delete.php', { id: identifier });                    
                        console.log(resp.data.response);
                        fetchDocs();
                    }
                }

                const isFormValid = computed(() => {
                    if (form.value.title && form.value.message
                        && (form.value.title?.length > 2) && (form.value.message?.length > 3)
                    ) {
                        return true;
                    }
                    return false;
                });

                async function storeDoc() {                    
                    if (!isFormValid.value) {
                        alert('Fields are too short or missing');                        
                        return;
                    }
                    const payload = { title: form.value.title, message: form.value.message };
                    const res = await axios.post(siteURL + 'api/upload.php', payload);
                    viewModal.value = false;
                    fetchDocs();
                }                

                function showAllDocs() {
                    docs.value.forEach(doc => doc.isVisible = true);
                }
                function hideAllDocs() {
                    docs.value.forEach(doc => doc.isVisible = false);
                }

                fetchDocs();

                return { docs, form, siteURL, viewModal, showAllDocs, hideAllDocs, storeDoc, deleteDoc, fetchDocs, isFormValid }
            }
        });

        app.mount('#app');
    </script>
<?php include 'views/footer.php'; ?>