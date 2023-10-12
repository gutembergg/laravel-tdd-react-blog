import imageBunner from '../../../assets/art-blog-home.avif';
import Button from '../../Form/Button';

function ImageBunner() {
    return (
        <div className="relative">
            <img className="object-cover w-full md:max-h-[500px]" src={imageBunner} alt="homepage-image" />

            <div className="md:absolute md:top-[50%] md:left-20">
                <h1 className="text-4xl mt-6 md:mt-0 md:text-6xl text-white font-extrabold outline-20">Art blog websites</h1>
                <Button className="mt-6">Créer compte</Button>
            </div>
        </div>
    );
}

export default ImageBunner;
