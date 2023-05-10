const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const PeopleList = () => import('./components/people/List.vue' /* webpackChunkName: "resource/js/components/people/list" */)
const PeopleCreate = () => import('./components/people/Add.vue' /* webpackChunkName: "resource/js/components/people/add" */)
const PeopleEdit = () => import('./components/people/Edit.vue' /* webpackChunkName: "resource/js/components/people/edit" */)

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'peopleList',
        path: '/people',
        component: PeopleList
    },
    {
        name: 'peopleEdit',
        path: '/people/:id/edit',
        component: PeopleEdit
    },
    {
        name: 'peopleAdd',
        path: '/people/add',
        component: PeopleCreate
    }
]