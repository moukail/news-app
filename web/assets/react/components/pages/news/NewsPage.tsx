
import LoadingView from '../../views/loading/LoadingView';
import React from "react";
import {Accordion, AccordionDetails, AccordionSummary} from "@mui/material";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import Typography from "@mui/material/Typography";
import SearchView from "../../views/search/SearchView";

class NewsPage extends React.Component<{}, any> {
    constructor() {
        super();
        this.state = { feedItems: [], loading: true};
    }

    componentDidMount() {
        this.setState({ loading: true });
        this.getFeedItems();
    }

    getFeedItems() {
        fetch('/api/v1/feed/item')
        .then(response => {
            return response.json();
        }).then(feedItems => {
            console.log(feedItems);
            this.setState({ feedItems: feedItems, loading: false})
        });
    }

    render() {
        const { feedItems, loading } = this.state;
        return(
            <div>
            {loading ? (
                <LoadingView />
            ) : (
                <div className={'row'}>
                    <SearchView/>

                    { feedItems.map(feedItem =>
                        <Accordion key={feedItem.id} id={feedItem.id}>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                                aria-controls="panel1a-content"
                                id="panel1a-header"
                                >
                                <Typography>{feedItem.title}</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <Typography dangerouslySetInnerHTML={{__html: feedItem.description}}/>
                            </AccordionDetails>
                        </Accordion>
                    )}
                </div>
            )}
            </div>
        )
    }
}

export default NewsPage