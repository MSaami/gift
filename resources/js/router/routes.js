import Codes from '../components/Codes'
import CodeUpdate from '../components/CodeUpdate'
import Winners from '../components/Winners'
const routes = [
    {
        path: '/admin/codes',
        name: 'code-index',
        component: Codes
    },
    {
        path: '/admin/codes/:id',
        name: 'code-update',
        component: CodeUpdate
    },
    {
        path: '/admin/winners',
        name: 'winner-index',
        component: Winners,
    },
];
export default routes;
