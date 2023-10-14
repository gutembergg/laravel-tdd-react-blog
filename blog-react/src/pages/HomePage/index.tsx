import ImageBunner from '../../Components/HomePage/ImageBunner';
import PostsList from '../../Components/Posts/PostsList/PostsList';
import { useApiRequests } from '../../hooks/useApiRequest';
import { Post } from '../../Interfaces/Post';
import DefaultLayout from '../../layouts/DefaultLayout';

import './styles.css';

function HomePage() {
    const { data, error, isLoading } = useApiRequests<Post[]>('http://localhost/api/posts/');

    return (
        <DefaultLayout>
            <div className="flex flex-col  bg-slate-950">
                <ImageBunner />
                <div>
                    <h1
                        id="post-list_title"
                        className="text-4xl text-yellow-600 text-center 
                        font-semibold py-12"
                    >
                        Derniers articles
                    </h1>

                    <PostsList data={data} error={error} isLoading={isLoading} />
                </div>

                <footer>Footer</footer>
            </div>
        </DefaultLayout>
    );
}

export default HomePage;
