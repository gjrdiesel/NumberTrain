<template>
    <div>
        <canvas width="400" height="450"></canvas>
    </div>
</template>
<script>
    export default {
        props: {
            data: Array,
        },
        mounted() {
            var ctx = this.$el.querySelector('canvas').getContext('2d');
            new Chart(ctx, {
                "type": "line",
                "data": {
                    "labels": [
                        '7', '6', '5', '4', '3', '2', '1', 'Today'
                    ],
                    "datasets": [{
                        "label": "Total Followers Last 7 Days",
                        "data": this.data,
                        "fill": false,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                    }]
                },
                "options": {}
            });
        }
    }
</script>
