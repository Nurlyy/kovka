<template>
    <div class="top-line-navigation">
        <nav>
            <a href="#" class="contacts-btn">Контакты</a>
            <span>+7 992 202 57 51</span>
            <span>malkov.sergey.a@yandex.ru</span>
            <span>Россия Санкт-Петербург Петровская коса 1</span>
        </nav>
    </div>
</template>

<script>
export default {
    name: "TopLineNavigation",
    data(){
        return {
            email: null,
            number: null,
            address: null,
        }
    },
    mounted() {
        axios.post("/api/get-contacts", {}).then((response) => {
            this.phone_number = response.data.contacts.phone_number;
            this.email = response.data.contacts.email;
            this.address = response.data.contacts.address;
        });
    },
};
</script>

<style scoped lang="scss">
.top-line-navigation {
    position: sticky;
    position: -webkit-sticky;
    height: var(--top-navigation-height);
    width: var(--top-navigation-width);
    top: 0;
    z-index: 4;
    background-color: var(--top-navigation-background-color);
    -webkit-box-shadow: var(--top-navigation-shadow);
    -moz-box-shadow: var(--top-navigation-shadow);
    box-shadow: var(--top-navigation-shadow);
    padding-top: var(--top-navigation-paddin);
    box-sizing: border-box;
    nav {
        max-width: var(--nav-max-width);
        height: var(--nav-height);
        padding: var(--nav-padding);
        box-sizing: border-box;
        margin: 0 auto;
        .contacts-btn {
            float: left;
            height: var(--height-btn-navigation);
            border: var(--border-btn-navigation);
            text-decoration: none;
            padding: var(--padding-btn-navigation);
            box-sizing: border-box;
            border-radius: var(--radius-btn-navigation);
            color: var(--color-btn-navigation);
            font-size: var(--font-size-btn-navigation);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family-btn-navigation);
            transition: var(--transition);
            &:hover {
                border-color: var(--color-hover-btn-navigation);
            }
        }
        span {
            float: right;
            height: var(--span-navigation);
            color: var(--color-white);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: var(--font-size-span-navigation);
            padding: var(--padding-span-navigation);
            box-sizing: border-box;
            border-right: var(--span-border-navigation);
            margin-top: 3px;
            &:nth-child(2) {
                padding: var(--padding-span-child-navigation);
                border-right: none !important;
                font-family: var(--font-span-child-navigation);
                font-size: var(--fontsize-span-child-navigation);
            }
            &:nth-child(4) {
                color: var(--color-lastspan-child-navigation);
            }
        }
    }
}
</style>
