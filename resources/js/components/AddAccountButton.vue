<template>
    <div>
        <button type="button" data-toggle="modal" data-target="#add-account" class="btn btn-outline-primary">
            Add account
        </button>

        <div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="add-account-label"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" action="/account" method="post">
                    <slot></slot>
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-account-label">Add a new account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>Start tracking a new account</p>

                        <div class="form-group">
                            <label for="type">Type of Account</label>
                            <select name="type" id="type" class="form-control">
                                <option v-for="type in types" :value="type.value">{{ type.name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="username">Username/Channel/ID</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Account</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        props: {
            types: Array
        }
    }
</script>
