import { RouterProvider } from 'react-router-dom';
import { router } from './Routes';
import DefaultLayout from './layouts/DefaultLayout';

function App() {
    return (
        <DefaultLayout>
            <RouterProvider router={router} />
        </DefaultLayout>
    );
}

export default App;
