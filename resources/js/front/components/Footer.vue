<template>
    <div class="wrapper-footer">
        <div class="footer">
            <span class="copy">© 2023 · ООО “Ковка и Дерево”</span>
            <span>{{ number }}</span>
            <span>{{ email }}</span>
            <span>{{ address }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            email: null,
            number: null,
            address: null,
        };
    },
    mounted() {
        axios.post("/api/get-contacts", {}).then((response) => {
            this.number = response.data.contacts.phone_number;
            this.email = response.data.contacts.email;
            this.address = response.data.contacts.address;
        });
    },
};
</script>

<style scoped lang="scss">
.wrapper-footer {
    width: 100%;
    border-top: 1px solid #cccccc;
    margin-top: 100px;
    height: 50px;
    background-color: #fff;
    .footer {
        max-width: var(--nav-max-width);
        height: var(--nav-height);
        padding: var(--nav-padding);
        box-sizing: border-box;
        margin: 10px auto;
        @media (max-width: 830px) {
            height: 72px;
        }
        .copy {
            float: left;
            height: var(--span-navigation);
            color: var(--color-black);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: var(--font-size-span-navigation);
            padding: var(--padding-span-navigation);
            box-sizing: border-box;
            border-right: 0 !important;
            margin-top: 3px;
            @media (max-width: 830px) {
                margin-top: 19px;
            }
        }
        span {
            float: right;
            height: var(--span-navigation);
            color: var(--color-black);
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
            @media (max-width: 830px) {
                border-right: none !important;
                padding: 9px 20px 0 0;
                &:nth-child(2) {
                    padding: 6px 0 0 0;
                    border-right: none !important;
                    font-family: var(--font-span-child-navigation);
                    font-size: var(--fontsize-span-child-navigation);
                }
                &:nth-child(4) {
                    display: block;
                    padding: 5px 0 0 20px;
                    border-right: none !important;
                }
            }
        }
    }
}
</style>
