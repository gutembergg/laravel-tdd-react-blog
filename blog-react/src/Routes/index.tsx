import { createBrowserRouter } from 'react-router-dom';
import HomePage from '../pages/HomePage';
import AllPosts from '../pages/AllPosts';
import PostShow from '../Components/Posts/Show';

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
        element: <PostShow />,
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
