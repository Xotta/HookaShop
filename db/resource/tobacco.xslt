<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="catalog/tobacco">
        <div class="item_container">
            <div class="item">
                <xsl:apply-templates select="img"/>
                <xsl:apply-templates select="name"/>
                <div class="item_form_container align_items_center">
                    <div class="item_form ">
                        <xsl:apply-templates select="price"/>
                        <div style="display: flex; justify-content: center" class="button_container">
                            <button style="alignment: center">Add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="item_full_info">
                    <div class="mb-3">Tastes:
                        <xsl:apply-templates select="tastes/taste"/>
                    </div>
                    <div style="height: 100px">Lol</div>
                </div>
            </div>
        </div>
    </xsl:template>

    <xsl:template match="img">
        <a>
            <img>
                <xsl:attribute name="class">
                    <xsl:text>item_photo lazy</xsl:text>
                </xsl:attribute>
                <xsl:attribute name="src">
                    <xsl:value-of select="@src"/>
                </xsl:attribute>
                <xsl:attribute name="alt">
                    <xsl:value-of select="@alt"/>
                </xsl:attribute></img>
        </a>
    </xsl:template>

    <xsl:template match="name">
        <a class="item_name">
            <xsl:attribute name="href">
                <xsl:value-of select="@src"/>
            </xsl:attribute>
            <xsl:value-of select="."/>
        </a>
    </xsl:template>
    <xsl:template match="price">
        <div class="item_price">
            Price:
            <span class="price">
                <xsl:value-of select="."/>
            </span>
        </div>
    </xsl:template>
    <xsl:template match="taste">
        <xsl:value-of select="."/>,
    </xsl:template>
</xsl:stylesheet>