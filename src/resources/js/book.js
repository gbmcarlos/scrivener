var Book = {

    listChapters: async function(fileHandle) {

        var book = await this.readBook(fileHandle);
        var chapters = book.getElementsByTagName("chapter");
        var chapterList = [];
        for (let i = 0; i < chapters.length; i++) {
            chapterList.push(parseInt(chapters[i].getAttribute("number")));
        }

        return chapterList;

    },

    getChapterContent: async function(fileHandle, chapterIndex) {

        var book = await this.readBook(fileHandle);
        var chapter = book.querySelector("chapter[number='" + chapterIndex + "']");

        var json = {
            blocks: []
        };
        for (var i = 0; i < chapter.children.length; i++) {
            json.blocks.push({
                type: 'paragraph',
                data: {
                    text: chapter.children[i].textContent
                }
            });
        }

        return json;

    },

    writeChapterContent: async function(chapterIndex, fileHandle, content) {

        var book = await this.readBook(fileHandle);
        var chapter = book.querySelector("chapter[number='" + chapterIndex + "']");

        // Replace the content of the chapter
        chapter.innerHTML = "\n            ";
        for (let i = 0; i < content.blocks.length; i++) {
            chapter.appendChild(this.prepareParagraph(
                content.blocks,
                i
            ));
        }

        var xmlSerializer = new XMLSerializer();
        var xmlContent = xmlSerializer.serializeToString(book);
        xmlContent = xmlContent.replace(/ xmlns="[^"]+"/g, '');

        const writable = await fileHandle.createWritable();
        await writable.write(xmlContent);
        await writable.close();

    },

    prepareParagraph: function(blocks, index) {

        var text = content.blocks[i].data.text;
        text = text.replace('\u00A0</p>', ""); // Remove any non-breaking space at the end of a paragraph
        text = text.replace('\u00A0', " "); // Replace any non-breaking space (inside a paragraph) with a normal space

        var pElement = document.createElement("p");
        pElement.textContent = text;
        chapter.appendChild(pElement);

        chapter.innerHTML += "\n        ";
        if (i < content.blocks.length -1) {
            chapter.innerHTML += "    ";
        }

        return pElement;

    },

    readBook: async function(fileHandle) {

        var file = await fileHandle.getFile();
        var fileContent = await file.text();
        var xmlParser = new DOMParser();
        return xmlParser.parseFromString(fileContent, "application/xml");

    }

};