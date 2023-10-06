import { useState } from 'react';

function App() {
    const [state, setState] = useState('test');

    return (
        <div>
            React js
            <div>{state}</div>
            <button onClick={() => setState('new Test')}>Test</button>
        </div>
    );
}

export default App;
