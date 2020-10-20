<!-- Cara jalaninnya ketik npm run watch di terminal-->
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Online Examination
                        <span class="float-right">{{questionIndex+1}}/{{questions.length}}</span>
                    </div>

                    <div class="card-body">
                        <span class="float-right" style="color:red;">{{time}}</span>
                        <div v-for="(question,index) in questions">
                            <div v-show="index===questionIndex">
                                {{index+1}}.{{question.question}}
                                <ol type="A">
                                    <li v-for="choice in question.answers">
                                        <label>
                                            <input type="radio"
                                            :value="choice.is_correct==true?true:choice.answer"
                                            :name="index"
                                            v-model="userResponses[index]"
                                            @click="choices(question.id, choice.id)"
                                            >
                                            {{choice.answer}}
                                        </label>
                                    </li> 
                                </ol>
                            </div>
                        </div>

                        <div v-show="questionIndex != questions.length">
                            <span v-show="questionIndex > 0">
                                <button class="btn btn-success"@click="prev()">Previous</button>
                            </span>
                            <button class="btn btn-success float-right"@click="next(); postUserChoice()">Next</button>
                        </div>
                        <div v-show="questionIndex === questions.length">
                            <center>You got:{{score()}}/{{questions.length}}</center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        props:['quizId', 'quizQuestions', 'hasQuizPlayed', 'times'],
        data(){
            return{
                questions:this.quizQuestions,
                questionIndex: 0,
                userResponses:Array(this.quizQuestions.length).fill(false),
                currentQuestion:0,
                currentAnswer:0,
                clock:moment(this.times*60*1000)
            }
        },
        mounted() {
            setInterval(()=>{
                this.clock = moment(this.clock.subtract(1,'seconds'))
            },1000);
        },
        computed:{
            time:function(){
                var minsec = this.clock.format('mm:ss');
                 if(minsec == '00:00'){
                     alert('Timeout!')
                     window.location.reload();
                }
                return minsec
            }
        },
        methods:{
            next(){
                this.questionIndex++
            },
            prev(){
                this.questionIndex--
            },
            choices(question, answer){
                this.currentAnswer=answer,
                this.currentQuestion=question
            },
            score(){
                return this.userResponses.filter((val)=>{
                    return val === true;
                }).length
            },
            postUserChoice(){
                axios.post('/quiz/create',{
                    answerId : this.currentAnswer,
                    questionId : this.currentQuestion,
                    quizId : this.quizId
                }).then((response) => {
                    console.log(response)
                }).catch((error)=>{
                    alert("ERROR!!")
                });
            }
        }
    }
</script>
