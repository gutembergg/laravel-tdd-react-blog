import { createBrowserRouter } from 'react-router-dom';
import HomePage from '../pages/HomePage';
import SearchPost from '../pages/SearchPost';
import ShowPost from '../pages/ShowPost';

export const router = createBrowserRouter([
    {
        path: '/',
        element: <HomePage />,
    },
    {
        path: '/posts',
        element: <SearchPost />,
    },
    {
        path: '/post/:slug',
        element: <ShowPost />,
    },
]);
