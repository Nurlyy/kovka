<template>
    <div class="call-me">
        <h3>Перезвоните мне</h3>
        <p>
            Сообщите пожалуйста удобное для вас время, ваше имя и номер телефона
        </p>
        <div class="conteaner-form">
            <input
                type="text"
                class="user"
                v-model="name"
                :value="name"
                placeholder="Ваше имя"
            />
            <input
                type="text"
                class="phone"
                v-model="phone"
                :value="phone"
                placeholder="Ваш номер телефона"
            />
            <input
                type="text"
                class="clock"
                v-model="clock"
                :value="clock"
                placeholder="Удобное время"
            />
            <button @click="getCookieToken">Отправить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CallMe",
    data() {
        return {
            name: "",
            phone: "",
            clock: "",
        };
    },
    methods: {
        getCookie(name) {
            const cookies = document.cookie.split(";");

            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();

                if (cookie.startsWith(`${name}=`)) {
                    return cookie.substring(name.length + 1);
                }
            }

            return null;
        },
        getCookieToken() {
            axios
                .get("/api/get-email-token", { withCredentials: true })
                .then((response) => {
                    console.log("got email token");
                    const cookie = this.getCookie("emailToken");
                    if (cookie != null && cookie != "undefined") {
                        console.log("check email token");

                        this.sendMail();
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        sendMail() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, "0");
            const day = String(now.getDate()).padStart(2, "0");
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            const dateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            var sendObject = {
                name: this.name,
                name: this.name,
                phone: this.phone,
                clock: this.clock,
                datetime: dateTime,
            };

            axios.post("/api/send-email", sendObject).then((response) => {
                console.log(response.data);
                if (response.data.status == "true") {
                    console.log("success");
                    this.name = "";
                    this.phone = "";
                    this.clock = "";
                } else {
                    console.log("failure");
                }
            });
        },
    },
};
</script>

<style scoped lang="scss">
.call-me {
    position: relative;
    width: var(--width-main);
    background-color: #fafafa;
    padding: 40px 20px;
    box-sizing: border-box;
    margin-top: 6px;
    h3 {
        display: block;
        padding: 0;
        margin: 0;
        text-align: center;
        width: var(--width-main);
        color: var(--color-purple-h2);
        font-size: var(--font-saze-h2);
        font-family: var(--font-family-neumann);
        font-weight: normal;
    }
    p {
        width: 100%;
        color: #969696;
        font-size: 14px;
        line-height: 22px;
        font-family: var(--font-family-times);
        text-align: center;
        padding: 5px 0 20px 0;
        margin: 0;
    }
    .conteaner-form {
        position: relative;
        max-width: 860px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr) 135px;
        grid-template-rows: 36px;
        gap: 5px;
        @media (max-width: 830px) {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 36px);
        }
        input {
            position: relative;
            height: 36px;
            background-color: #fff;
            border: 1px solid #c4c4c4;
            box-sizing: border-box;
            outline: none;
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: 14px;
            padding: 0 36px 0 12px;
            width: 100%;
            &::placeholder {
                color: #5e4186;
            }
            &::-webkit-input-placeholder {
                color: #5e4186;
            }
            &::-ms-input-placeholder {
                color: #5e4186;
            }
            &:-moz-placeholder {
                color: #5e4186;
                opacity: 1;
            }
            &::-moz-placeholder {
                color: #5e4186;
                opacity: 1;
            }
            &:-ms-input-placeholder {
                color: #5e4186;
            }
            &.user {
                background-image: url(@/front/assets/images/user.svg);
                background-repeat: no-repeat;
                background-position: right 6px center;
                background-size: 22px;
            }
            &.phone {
                background-image: url(@/front/assets/images/phone.svg);
                background-repeat: no-repeat;
                background-position: right 8px center;
                background-size: 20px;
            }
            &.clock {
                background-image: url(@/front/assets/images/clock.svg);
                background-repeat: no-repeat;
                background-position: right 8px center;
                background-size: 20px;
            }
        }
        button {
            border: 0;
            background-color: #412b5f;
            outline: none;
            color: var(--color-white);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: 14px;
            height: 36px;
            cursor: pointer;
        }
    }
}
</style>
