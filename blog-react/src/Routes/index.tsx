import { createBrowserRouter } from 'react-router-dom';
import HomePage from '../pages/HomePage';
import AllPosts from '../pages/AllPosts';

export const router = createBrowserRouter([
    {
        path: '/',
        element: <HomePage />,
    },
    {
        path: '/posts',
        element: <AllPosts />,
    },
]);
