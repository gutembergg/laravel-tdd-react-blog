import { ReactNode } from 'react';
import { Header } from '../Components/Header';
import { SiMusicbrainz } from 'react-icons/si';

type Props = {
    children: ReactNode;
};

function DefaultLayout({ children }: Props) {
    return (
        <div>
            <Header.Root>
                <Header.Icon icon={SiMusicbrainz} />
                <Header.Links />
            </Header.Root>
            <div className="w-full h-[100vh]">{children}</div>
        </div>
    );
}

export default DefaultLayout;
