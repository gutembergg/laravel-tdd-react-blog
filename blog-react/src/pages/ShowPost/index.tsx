import { useParams } from 'react-router-dom';
import { Show } from '../../Components/Posts/Show';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import { Post } from '../../Interfaces/Post';
import { checkHasImage, formaterPost } from '../../Utils/Api/formaterPosts';
import Loading from '../../Components/Utils/Loading';

function ShowPost() {
    const { slug } = useParams();

    const { data, error, isLoading } = useApiRequests<Post>(`http://localhost/api/posts/show/${slug}`);

    if (!data || error) {
        return <div>Not found</div>;
    }

    if (isLoading) {
        return <Loading />;
    }

    const formatedPost = formaterPost(data);

    return (
        <DefaultLayout>
            <div className="w-full my-auto flex items-center justify-center">
                <Show.Root>
                    <Show.Image path={checkHasImage(formatedPost).path} name={formatedPost.title} />
                    <Show.Title className="text-white" title={formatedPost.title} />
                    <Show.Content className="text-white" content={formatedPost.content} />
                    <div className="w-full flex justify-between">
                        <Show.Author className="text-white" name={formatedPost.author.name} />
                        <Show.Date className="text-white" date={formatedPost.created_at} />
                    </div>
                </Show.Root>
            </div>
        </DefaultLayout>
    );
}

export default ShowPost;
