<template>
    <div class="my-2">
        <canvas width="100" height="30"></canvas>
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
                        "label": "",
                        "data": this.data,
                        "fill": false,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                    }]
                },
                "options": {
                    responsive: false,
                    legend: {
                        display: false
                    },
                    elements: {
                        line: {
                            borderColor: '#000000',
                            borderWidth: 1
                        },
                        point: {
                            radius: 0
                        }
                    },
                    tooltips: {
                        enabled: false
                    },
                    scales: {
                        yAxes: [
                            {
                                display: false
                            }
                        ],
                        xAxes: [
                            {
                                display: false
                            }
                        ]
                    }
                }
            });
        }
    }
</script>
