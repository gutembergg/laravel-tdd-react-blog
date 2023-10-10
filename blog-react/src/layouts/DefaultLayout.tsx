import { ReactNode } from 'react';
import Header from '../Components/Header';

type Props = {
    children: ReactNode;
};

function DefaultLayout({ children }: Props) {
    return (
        <div>
            <Header />
            <div>{children}</div>
        </div>
    );
}

export default DefaultLayout;
