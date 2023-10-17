import { createBrowserRouter } from 'react-router-dom';
import HomePage from '../pages/HomePage';
import AllPosts from '../pages/AllPosts';
import ShowPost from '../pages/ShowPost';

export const router = createBrowserRouter([
    {
        path: '/',
        element: <HomePage />,
    },
    {
        path: '/posts',
        element: <AllPosts />,
    },
    {
        path: '/post/:slug',
        element: <ShowPost />,
    },
]);

/* export const router = () => {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<HomePage />}></Route>
                <Route path="/posts" element={<AllPosts />}></Route>
            </Routes>
        </BrowserRouter>
    );
};
 */
